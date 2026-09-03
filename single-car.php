<?php get_header(); ?>

<main class="main-container single-car-container">
    <?php while (have_posts()) : the_post(); 
        // 1. ดึงค่า ACF ทั้งหมด
        $price          = get_field('price');
        $year           = get_field('year');
        $mileage        = get_field('mileage');
        $fuel_type      = get_field('fuel_type');
        $engine         = get_field('engine');
        $transmission   = get_field('transmission');
        $exterior_color = get_field('exterior_color');
    ?>

    <!-- ชื่อรุ่นรถ -->
    <div class="car-header-title">
        <h1><?php the_title(); ?> <span class="badge-condition">Grade A Condition</span></h1>
    </div>

    <div class="car-detail-layout">
        <!-- ฝั่งซ้าย: รูปภาพ -->
        <div class="car-gallery-column">
            <div class="main-car-photo">
                <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                <img src="https://via.placeholder.com/600x400?text=No+Car+Photo" alt="No image">
                <?php endif; ?>
            </div>

            <div class="thumb-gallery">
                <div class="thumb-item"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="thumb">
                    <p>Front View</p>
                </div>
                <div class="thumb-item"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="thumb">
                    <p>Interior</p>
                </div>
                <div class="thumb-item"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="thumb">
                    <p>Console</p>
                </div>
                <div class="thumb-item"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="thumb">
                    <p>Engine</p>
                </div>
            </div>
        </div>

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

<?php get_footer(); ?>