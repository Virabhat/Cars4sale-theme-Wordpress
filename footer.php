<footer class="site-footer" id="contact">
    <div class="footer-container">
        <!-- คอลัมน์ 1: แบรนด์และคำแนะนำ -->
        <div class="footer-col">
            <h4>Cars4Sale</h4>
            <p>เต็นท์รถยนต์มือสองคุณภาพ คัดเกรด A ตรวจเช็กมาตรฐานทุกคัน เอกสารครบพร้อมโอนทันที</p>
            <p style="margin-top: 10px;">
                <strong>โทร:</strong> <a href="tel:+66810000000">+66 81-XXX-XXXX</a><br>
                <strong>LINE:</strong> @cars4sale<br>
                <strong>เวลาทำการ:</strong> จันทร์ - อาทิตย์ 09:00 - 18:00 น.
            </p>
        </div>

        <!-- คอลัมน์ 2: เมนูลัด / นโยบาย -->
        <div class="footer-col">
            <h4>Quick Links</h4>
            <p><a href="<?php echo esc_url(home_url('/#cars')); ?>">ดูรายการรถทั้งหมด</a></p>
            <p><a href="<?php echo esc_url(home_url('/#cars')); ?>">รถเข้าใหม่ล่าสุด</a></p>
            <p><a href="https://line.me/ti/p/~YOUR_LINE_ID" target="_blank">ปรึกษาเรื่องจัดไฟแนนซ์</a></p>
            <p><a href="tel:+66810000000">นัดหมายทดลองขับ (Test Drive)</a></p>
        </div>

        <!-- คอลัมน์ 3: แผนที่หน้าร้าน (Google Maps) -->
        <div class="footer-col footer-map-col">
            <h4>Location & Map</h4>
            <p>แวะเข้ามาดูรถคันจริงได้ที่โชว์รูมของเรา</p>
            <div class="map-embed-wrapper">
                <!-- สามารถเปลี่ยน src แผนที่เป็นพิกัดร้านจริงได้เลยครับ -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.7661502447953!2d100.5530188!3d13.7325603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQzJzU3LjIiTiAxMDDCsDMzJzEwLjkiRQ!5e0!3m2!1sth!2sth!4v1620000000000!5m2!1sth!2sth"
                    width="100%" height="160" style="border:0; border-radius: 6px;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
            <a href="https://maps.google.com" target="_blank" class="btn-open-map">📍 เปิด Google Maps นำทาง</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Cars4Sale. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>