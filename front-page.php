<?php get_header(); ?>

<!-- ส่วน Banner พร้อมฟอร์มค้นหา/กรองรถ -->
<section class="hero-section">
    <div class="hero-content">
        <h1><br>Cars4Sale รถมือสองคุณภาพ คัดชัวร์ ตรวจจริง ทุกคัน</h1>
        <p>
            รวมรถมือสองสภาพสวย คัดสรรอย่างมืออาชีพ ดอกเบี้ยพิเศษ อนุมัติไว เอกสารไม่ยุ่งยาก
            มีทีมงานคอยดูแลทุกขั้นตอนจนได้รับรถ
        </p>

        <!-- ฟอร์มค้นหาและกรองรถ -->
        <form method="GET" action="#cars" class="car-filter-form">
            <input type="text" name="s_keyword" placeholder="ค้นหาชื่อรุ่นรถ เช่น Honda, Toyota..."
                value="<?php echo esc_attr(isset($_GET['s_keyword']) ? $_GET['s_keyword'] : ''); ?>">

            <select name="s_fuel">
                <option value="">ทุกประเภทเชื้อเพลิง</option>
                <option value="เบนซิน" <?php selected(isset($_GET['s_fuel']) ? $_GET['s_fuel'] : '', 'เบนซิน'); ?>>
                    เบนซิน</option>
                <option value="ดีเซล" <?php selected(isset($_GET['s_fuel']) ? $_GET['s_fuel'] : '', 'ดีเซล'); ?>>ดีเซล
                </option>
                <option value="ไฮบริด" <?php selected(isset($_GET['s_fuel']) ? $_GET['s_fuel'] : '', 'ไฮบริด'); ?>>
                    ไฮบริด</option>
                <option value="ไฟฟ้า" <?php selected(isset($_GET['s_fuel']) ? $_GET['s_fuel'] : '', 'ไฟฟ้า'); ?>>ไฟฟ้า
                    (EV)</option>
            </select>

            <button type="submit" class="btn-filter-submit">ค้นหารถ</button>
            <?php if (!empty($_GET['s_keyword']) || !empty($_GET['s_fuel'])): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-filter-reset">ล้างการค้นหา</a>
            <?php endif; ?>
        </form>
    </div>
</section>

<!-- ส่วนแสดงการ์ดรถยนต์ LATEST ARRIVALS -->
<main class="main-container" id="cars">
    <div class="section-title">
        <h2><?php echo (!empty($_GET['s_keyword']) || !empty($_GET['s_fuel'])) ? 'ผลการค้นหารถยนต์' : 'รถยนต์เข้ามาใหม่'; ?>
        </h2>
    </div>

    <div class="cars-grid">
        <?php
        // 1. รับค่าจากฟอร์มค้นหา
        $keyword = isset($_GET['s_keyword']) ? sanitize_text_field($_GET['s_keyword']) : '';
        $fuel = isset($_GET['s_fuel']) ? sanitize_text_field($_GET['s_fuel']) : '';

        // 2. ตั้งค่า Query
        $args = array(
            'post_type' => 'car',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            's' => $keyword, // ค้นหาจากชื่อรุ่นรถ
        );

        // 3. กรองเพิ่มจากฟิลด์ ACF 'fuel_type' ถ้ามีการเลือก
        if (!empty($fuel)) {
            $args['meta_query'] = array(
                array(
                    'key' => 'fuel_type',
                    'value' => $fuel,
                    'compare' => 'LIKE'
                )
            );
        }

        $car_query = new WP_Query($args);

        if ($car_query->have_posts()):
            while ($car_query->have_posts()):
                $car_query->the_post();
                $price = get_field('price');
                $year = get_field('year');
                $mileage = get_field('mileage');
                $fuel_type = get_field('fuel_type');
                $status = get_field('car_status') ? get_field('car_status') : 'available';
                ?>
                <!-- โครงการ์ดรถ (เหมือนเดิม) -->
                <div class="car-card status-<?php echo esc_attr($status); ?>">
                    <div class="car-image">
                        <?php if ($status === 'sold'): ?>
                            <span class="badge-status status-sold">ขายแล้ว</span>
                        <?php elseif ($status === 'reserved'): ?>
                            <span class="badge-status status-reserved">ติดจอง</span>
                        <?php else: ?>
                            <span class="badge-status status-available">พร้อมขาย</span>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php else: ?>
                                <img src="https://via.placeholder.com/400x250?text=No+Image" alt="No image">
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="car-info">
                        <h3 class="car-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="car-price"><?php echo esc_html($price); ?></div>

                        <div class="car-specs">
                            <span>📅 <?php echo esc_html($year); ?></span>
                            <span>🛣️ <?php echo esc_html($mileage); ?></span>
                            <span>⛽ <?php echo esc_html($fuel_type); ?></span>
                        </div>

                        <a href="tel:+66810000000" class="btn-call">
                            CALL NOW: +66 81-XXX-XXXX
                        </a>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p style="grid-column: 1/-1; text-align: center; color: #777;">ไม่พบรถยนต์ที่ตรงกับเงื่อนไขการค้นหาของคุณ</p>';
        endif;
        ?>
    </div>
</main>

<!-- ส่วนทำไมต้องเลือกเรา (WHY CHOOSE US?) -->
<section class="section-features">
    <div class="main-container">
        <div class="section-title">
            <h2>WHY CHOOSE US?</h2>
        </div>
        <div class="features-grid">
            <div class="feature-box">
                <div class="feature-icon">🔍</div>
                <h3>Inspection</h3>
                <p>ผ่านการตรวจเช็กสภาพมาตรฐานอย่างละเอียด</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">⭐</div>
                <h3>Quality</h3>
                <p>คัดสรรเฉพาะรถคุณภาพ ไม่มีชนหนักหรือน้ำท่วม</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">🛡️</div>
                <h3>Warranty</h3>
                <p>มีรับประกันหลังการขาย มั่นใจได้ทุกการขับขี่</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon">🔒</div>
                <h3>Security</h3>
                <p>เอกสารและเล่มทะเบียนถูกต้อง โอนกรรมสิทธิ์ได้ 100%</p>
            </div>
        </div>
    </div>
</section>

<!-- ส่วนขั้นตอนการซื้อรถ (OUR PROCESS) -->
<section class="section-process">
    <div class="main-container">
        <div class="section-title">
            <h2>OUR PROCESS</h2>
        </div>
        <div class="process-grid">
            <div class="process-step">
                <div class="process-icon">🚘</div>
                <h3>1. Browse</h3>
                <p>เลือกรุ่นรถที่ถูกใจผ่านหน้าเว็บไซต์</p>
            </div>
            <div class="process-step">
                <div class="process-icon">📞</div>
                <h3>2. Call</h3>
                <p>โทรสอบถามหรือทักแชทเพื่อนัดหมาย</p>
            </div>
            <div class="process-step">
                <div class="process-icon">🔑</div>
                <h3>3. Test Drive</h3>
                <p>เข้ามาดูคันจริงและทดลองขับได้ฟรี</p>
            </div>
            <div class="process-step">
                <div class="process-icon">🛒</div>
                <h3>4. Buy</h3>
                <p>ปิดการขาย ทำสัญญา พร้อมรับรถกลับบ้าน</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>