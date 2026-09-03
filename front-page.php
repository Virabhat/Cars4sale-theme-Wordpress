<?php get_header(); ?>

<!-- ส่วน Banner ค้นหาตามแบบดีไซน์ -->
<section class="hero-section">
    <div class="hero-content">
        <h1>FIND QUALITY USED CARS.<br>NO SIGN-UP NEEDED!<br>CALL US DIRECTLY.</h1>
        <p>Browse our curated selection and call us today for details and a test drive.</p>
    </div>
</section>

<!-- ส่วนแสดงการ์ดรถยนต์ LATEST ARRIVALS -->
<main class="main-container" id="cars">
    <div class="section-title">
        <h2>LATEST ARRIVALS</h2>
    </div>

    <div class="cars-grid">
        <?php
        // เขียน Query ดึงข้อมูลจาก CPT 'car' ที่เราสร้างไว้
        $args = array(
            'post_type' => 'car',
            'posts_per_page' => 8,
            'post_status' => 'publish'
        );
        $car_query = new WP_Query($args);

        if ($car_query->have_posts()):
            while ($car_query->have_posts()):
                $car_query->the_post();
                // ดึงค่าจาก ACF ที่เราตั้งไว้
                $price = get_field('price');
                $year = get_field('year');
                $mileage = get_field('mileage');
                $fuel_type = get_field('fuel_type');
                ?>
        <!-- โครงการ์ดรถแต่ละคัน -->
        <div class="car-card">
            <div class="car-image">
                <!-- ใส่แท็ก a ครอบรูปภาพ -->
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large'); ?>
                    <?php else : ?>
                    <img src="https://via.placeholder.com/400x250?text=No+Image" alt="No image">
                    <?php endif; ?>
                </a>
            </div>

            <div class="car-info">
                <!-- ใส่แท็ก a ครอบชื่อหัวข้อรถ -->
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
            echo '<p>ยังไม่มีรายการรถในระบบ กรุณาเพิ่มรถที่หลังบ้านครับ</p>';
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