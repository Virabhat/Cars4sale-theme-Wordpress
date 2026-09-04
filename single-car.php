<?php get_header(); ?>

<main class="main-container single-car-container">
    <?php while (have_posts()):
        the_post();
        // 1. ดึงค่า ACF ทั้งหมด
        $price = get_field('price');
        $year = get_field('year');
        $mileage = get_field('mileage');
        $fuel_type = get_field('fuel_type');
        $engine = get_field('engine');
        $transmission = get_field('transmission');
        $exterior_color = get_field('exterior_color');
        ?>

    <!-- ชื่อรุ่นรถ -->
    <div class="car-header-title">
        <h1><?php the_title(); ?> <span class="badge-condition">Grade A Condition</span></h1>
    </div>

    <div class="car-detail-layout">
        <!-- ฝั่งซ้าย: รูปภาพหลัก + รูปรองที่คลิกสลับได้ -->
        <div class="car-gallery-column">
            <?php
                $main_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $img_1 = get_field('gallery_img_1');
                $img_2 = get_field('gallery_img_2');
                $img_3 = get_field('gallery_img_3');
                ?>
            <div class="main-car-photo">
                <?php if ($main_thumb): ?>
                <img id="current-featured-img" src="<?php echo esc_url($main_thumb); ?>" alt="<?php the_title(); ?>">
                <?php else: ?>
                <img id="current-featured-img" src="https://via.placeholder.com/600x400?text=No+Photo" alt="No photo">
                <?php endif; ?>
            </div>

            <div class="thumb-gallery">
                <!-- รูปหลักเดิม -->
                <?php if ($main_thumb): ?>
                <div class="thumb-item" onclick="changeImage('<?php echo esc_url($main_thumb); ?>')">
                    <img src="<?php echo esc_url($main_thumb); ?>" alt="Main view">
                    <p>ภายนอก</p>
                </div>
                <?php endif; ?>

                <!-- รูปรอง 1 -->
                <?php if ($img_1): ?>
                <div class="thumb-item" onclick="changeImage('<?php echo esc_url($img_1); ?>')">
                    <img src="<?php echo esc_url($img_1); ?>" alt="Gallery 1">
                    <p>ภายใน</p>
                </div>
                <?php endif; ?>

                <!-- รูปรอง 2 -->
                <?php if ($img_2): ?>
                <div class="thumb-item" onclick="changeImage('<?php echo esc_url($img_2); ?>')">
                    <img src="<?php echo esc_url($img_2); ?>" alt="Gallery 2">
                    <p>คอนโซล</p>
                </div>
                <?php endif; ?>

                <!-- รูปรอง 3 -->
                <?php if ($img_3): ?>
                <div class="thumb-item" onclick="changeImage('<?php echo esc_url($img_3); ?>')">
                    <img src="<?php echo esc_url($img_3); ?>" alt="Gallery 3">
                    <p>ห้องเครื่อง</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- สคริปต์สลับรูปภาพแบบง่าย -->
        <script>
        function changeImage(imageUrl) {
            document.getElementById('current-featured-img').src = imageUrl;
        }
        </script>

        <!-- ฝั่งขวา: ข้อมูลรถ และ ปุ่มติดต่อ -->
        <div class="car-summary-column">
            <div class="single-price"><?php echo esc_html($price); ?></div>

            <!-- กล่อง KEY FACTS -->
            <div class="key-facts-box">
                <div class="facts-title">KEY FACTS</div>
                <div class="facts-grid">
                    <div class="fact-item">
                        <span class="fact-icon">📅</span>
                        <div>
                            <small>YEAR</small>
                            <strong><?php echo esc_html($year ? $year : '-'); ?></strong>
                        </div>
                    </div>
                    <div class="fact-item">
                        <span class="fact-icon">⏲️</span>
                        <div>
                            <small>ODOMETER</small>
                            <strong><?php echo esc_html($mileage ? $mileage : '-'); ?></strong>
                        </div>
                    </div>
                    <div class="fact-item">
                        <span class="fact-icon">⛽</span>
                        <div>
                            <small>FUEL</small>
                            <strong><?php echo esc_html($fuel_type ? $fuel_type : '-'); ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ตารางสเปก ESSENTIAL VEHICLE DATA (ดึงค่า ACF ไดนามิก) -->
            <div class="specs-section">
                <h4>ESSENTIAL VEHICLE DATA</h4>
                <table class="specs-table">
                    <tr>
                        <td>Engine</td>
                        <td><?php echo esc_html($engine ? $engine : '2.0L'); ?></td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td><?php echo esc_html($transmission ? $transmission : 'Automatic'); ?></td>
                    </tr>
                    <tr>
                        <td>Exterior Color</td>
                        <td><?php echo esc_html($exterior_color ? $exterior_color : 'Standard'); ?></td>
                    </tr>
                </table>
            </div>

            <!-- กล่องคำนวณค่างวดเบื้องต้น (Loan Calculator) -->
            <?php
                    // แปลงค่าราคา เช่น "฿890,000" ให้เป็นตัวเลขล้วนเพื่อใช้คำนวณ
                    $raw_price = preg_replace('/[^0-9]/', '', $price);
                    $numeric_price = !empty($raw_price) ? intval($raw_price) : 500000;
                ?>
            <div class="loan-calculator-box">
                <h4>🧮 คำนวณค่างวดเบื้องต้น</h4>

                <div class="calc-grid">
                    <div class="calc-field">
                        <label>เงินดาวน์:</label>
                        <select id="calc-down">
                            <option value="0">0% (ฟรีดาวน์)</option>
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                            <option value="20" selected>20%</option>
                            <option value="25">25%</option>
                            <option value="30">30%</option>
                        </select>
                    </div>

                    <div class="calc-field">
                        <label>ระยะเวลาผ่อน:</label>
                        <select id="calc-months">
                            <option value="36">36 เดือน (3 ปี)</option>
                            <option value="48">48 เดือน (4 ปี)</option>
                            <option value="60" selected>60 เดือน (5 ปี)</option>
                            <option value="72">72 เดือน (6 ปี)</option>
                            <option value="84">84 เดือน (7 ปี)</option>
                        </select>
                    </div>

                    <div class="calc-field">
                        <label>ดอกเบี้ยต่อปี (%):</label>
                        <input type="number" id="calc-interest" value="4.5" step="0.1" min="1" max="15">
                    </div>
                </div>

                <!-- แสดงผลลัพธ์ค่างวด -->
                <div class="calc-result">
                    <span>ประมาณการผ่อนต่อเดือน:</span>
                    <div class="calc-monthly-price">
                        <span id="monthly-payment-display">0</span> <strong>บาท/เดือน</strong>
                    </div>
                    <small>* รวม VAT 7% แล้ว (การคำนวณเบื้องต้น เป็นไปตามเงื่อนไขไฟแนนซ์)</small>
                </div>
            </div>

            <!-- สคริปต์คำนวณ Real-time -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carPrice = <?php echo json_encode($numeric_price); ?>;
                const downSelect = document.getElementById('calc-down');
                const monthsSelect = document.getElementById('calc-months');
                const interestInput = document.getElementById('calc-interest');
                const displayPayment = document.getElementById('monthly-payment-display');

                function updateMonthlyPayment() {
                    const downPercent = parseFloat(downSelect.value) || 0;
                    const months = parseInt(monthsSelect.value) || 60;
                    const interestRate = parseFloat(interestInput.value) || 0;

                    // 1. ยอดจัด = ราคารถ - เงินดาวน์
                    const downAmount = carPrice * (downPercent / 100);
                    const loanAmount = carPrice - downAmount;

                    // 2. ดอกเบี้ยรวม = ยอดจัด * ดอกเบี้ยต่อปี * จำนวนปี
                    const years = months / 12;
                    const totalInterest = loanAmount * (interestRate / 100) * years;

                    // 3. ยอดหนี้รวม
                    const totalDebt = loanAmount + totalInterest;

                    // 4. ค่างวดต่อเดือน + VAT 7%
                    const monthlyPreVat = totalDebt / months;
                    const monthlyWithVat = monthlyPreVat * 1.07;

                    // ฟอร์แมตใส่ลูกน้ำคั่นหลักพัน เช่น 12,450
                    displayPayment.innerText = Math.round(monthlyWithVat).toLocaleString('th-TH');
                }

                // สั่งให้คำนวณทันทีที่โหลดหน้า และเมื่อมีการเปลี่ยนค่าใน Dropdown/Input
                updateMonthlyPayment();
                downSelect.addEventListener('change', updateMonthlyPayment);
                monthsSelect.addEventListener('change', updateMonthlyPayment);
                interestInput.addEventListener('input', updateMonthlyPayment);
            });
            </script>

            <!-- กล่องปุ่มติดต่อ Call & LINE -->
            <div class="contact-action-group">
                <a href="tel:+66810000000" class="btn-call-detail">
                    📞 CALL NOW: +66 81-XXX-XXXX
                </a>
                <!-- เปลี่ยน YOUR_LINE_ID เป็นไอดีไลน์จริงได้เลยครับ -->
                <a href="https://line.me/ti/p/~YOUR_LINE_ID" target="_blank" class="btn-line-detail">
                    💬 สอบถามข้อมูลทาง LINE
                </a>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
</main>

<div class="mobile-sticky-bar">
    <a href="tel:+66810000000" class="btn-sticky call">
        📞 โทรสอบถาม
    </a>
    <a href="https://line.me/ti/p/~YOUR_LINE_ID?text=<?php echo urlencode('สนใจสอบถามข้อมูลรถ: ' . get_the_title()); ?>"
        target="_blank" class="btn-sticky line">
        💬 แชท LINE
    </a>
</div>

<?php get_footer(); ?>