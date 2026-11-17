<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero
            ['key' => 'home.hero_tagline', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero tagline', 'sort_order' => 10,
                'value_az' => 'Avtomobil icarəsi', 'value_en' => 'Rent a Car', 'value_ru' => 'Аренда авто'],
            ['key' => 'home.hero_location', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero location label', 'sort_order' => 20,
                'value_az' => 'Azərbaycan', 'value_en' => 'Azerbaijan', 'value_ru' => 'Азербайджан'],
            ['key' => 'home.hero_title_accent', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero title (accent)', 'sort_order' => 30,
                'value_az' => 'ASAN', 'value_en' => 'EASY', 'value_ru' => 'ЛЕГКИЙ'],
            ['key' => 'home.hero_title', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero title', 'sort_order' => 40,
                'value_az' => 'VƏ SÜRƏTLİ AVTOMOBİL İCARƏSİ', 'value_en' => 'AND FAST WAY TO RENT YOUR CAR', 'value_ru' => 'И БЫСТРЫЙ СПОСОБ АРЕНДОВАТЬ АВТО'],
            ['key' => 'home.hero_text', 'group' => 'home_hero', 'type' => 'textarea', 'label' => 'Hero text', 'sort_order' => 50,
                'value_az' => 'İstər həftəsonu səyahəti, istərsə də uzun yol planlaşdırın — biz sizə kömək edirik. Geniş avtomobil seçimi və rahat rezervasiya sistemi ilə icarə heç vaxt bu qədər asan olmayıb.',
                'value_en' => 'Whether you are planning a weekend getaway or a long trip, we have you covered. With our wide selection of vehicles and convenient booking system, renting a car has never been this effortless.',
                'value_ru' => 'Планируете выходные или длинную поездку — мы поможем. Большой выбор автомобилей и удобное бронирование делают аренду простой.'],
            ['key' => 'home.hero_cta_cars', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero button: Cars', 'sort_order' => 60,
                'value_az' => 'MAŞINLAR', 'value_en' => 'CARS', 'value_ru' => 'АВТО'],
            ['key' => 'home.hero_cta_contact', 'group' => 'home_hero', 'type' => 'text', 'label' => 'Hero button: Contact', 'sort_order' => 70,
                'value_az' => 'ƏLAQƏ', 'value_en' => 'CONTACT US', 'value_ru' => 'КОНТАКТЫ'],
            ['key' => 'home.hero_image', 'group' => 'home_hero', 'type' => 'image', 'label' => 'Hero image', 'sort_order' => 80,
                'value_az' => '/images/home car.png', 'value_en' => '/images/home car.png', 'value_ru' => '/images/home car.png'],

            // Cars section
            ['key' => 'home.cars_heading', 'group' => 'home_cars', 'type' => 'text', 'label' => 'Cars section heading', 'sort_order' => 10,
                'value_az' => 'Populyar icarə maşınları', 'value_en' => 'Popular rental cars', 'value_ru' => 'Популярные авто для аренды'],
            ['key' => 'home.cars_see_all', 'group' => 'home_cars', 'type' => 'text', 'label' => 'See all button', 'sort_order' => 20,
                'value_az' => 'Hamısı', 'value_en' => 'See All', 'value_ru' => 'Все'],

            // Stats
            ['key' => 'home.stats_title_1', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stats title part 1', 'sort_order' => 10,
                'value_az' => 'Bizim', 'value_en' => 'Our', 'value_ru' => 'Наши'],
            ['key' => 'home.stats_title_2', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stats title part 2', 'sort_order' => 20,
                'value_az' => 'Rəqəmlər', 'value_en' => 'Numbers', 'value_ru' => 'цифры'],
            ['key' => 'home.stat_1_value', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 1 value', 'sort_order' => 30,
                'value_az' => '80', 'value_en' => '80', 'value_ru' => '80'],
            ['key' => 'home.stat_1_label', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 1 label', 'sort_order' => 40,
                'value_az' => 'Super avtomobillər', 'value_en' => 'Super Cars', 'value_ru' => 'Суперкары'],
            ['key' => 'home.stat_2_value', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 2 value', 'sort_order' => 50,
                'value_az' => '4500 +', 'value_en' => '4500 +', 'value_ru' => '4500 +'],
            ['key' => 'home.stat_2_label', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 2 label', 'sort_order' => 60,
                'value_az' => 'Məmnun müştəri', 'value_en' => 'Satisfied Client', 'value_ru' => 'Довольные клиенты'],
            ['key' => 'home.stat_3_value', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 3 value', 'sort_order' => 70,
                'value_az' => '7000', 'value_en' => '7000', 'value_ru' => '7000'],
            ['key' => 'home.stat_3_label', 'group' => 'home_stats', 'type' => 'text', 'label' => 'Stat 3 label', 'sort_order' => 80,
                'value_az' => 'Rezervasiya', 'value_en' => 'Reservation', 'value_ru' => 'Бронирование'],

            // Why us
            ['key' => 'home.why_title_1', 'group' => 'home_why', 'type' => 'text', 'label' => 'Why us title part 1', 'sort_order' => 10,
                'value_az' => 'Niyə', 'value_en' => 'Why', 'value_ru' => 'Почему'],
            ['key' => 'home.why_title_2', 'group' => 'home_why', 'type' => 'text', 'label' => 'Why us title part 2', 'sort_order' => 20,
                'value_az' => 'bizi seçməlisiniz', 'value_en' => 'Choose us', 'value_ru' => 'выбирают нас'],
            ['key' => 'home.why_intro', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Why us intro', 'sort_order' => 30,
                'value_az' => 'Məmnuniyyətinizi ön planda tuturuq və icarə prosesini mümkün qədər rahat edirik. Baxımlı avtomobillər, rəqabətli qiymətlər və sadə rezervasiya ilə ehtiyaclarınızı qarşılayırıq.',
                'value_en' => 'We prioritize your satisfaction and strive to make your car rental experience as seamless as possible. With our wide selection of well-maintained vehicles, competitive prices, and simple booking process, you can trust us to meet your needs.',
                'value_ru' => 'Мы ставим ваш комфорт на первое место и делаем аренду максимально удобной. Исправные авто, выгодные цены и простой процесс бронирования.'],
            ['key' => 'home.why_1_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 1 title', 'sort_order' => 40,
                'value_az' => 'Müştəri dəstəyi', 'value_en' => 'Customer Support', 'value_ru' => 'Поддержка'],
            ['key' => 'home.why_1_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 1 text', 'sort_order' => 50,
                'value_az' => 'Komandamız ehtiyac olduqda yüksək səviyyəli dəstək göstərməyə hazırdır.',
                'value_en' => 'Our dedicated team is here to provide exceptional customer support whenever you need it.',
                'value_ru' => 'Наша команда всегда готова помочь.'],
            ['key' => 'home.why_2_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 2 title', 'sort_order' => 60,
                'value_az' => 'Super avtomobillər', 'value_en' => 'Super Cars', 'value_ru' => 'Суперкары'],
            ['key' => 'home.why_2_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 2 text', 'sort_order' => 70,
                'value_az' => 'Premium avtomobillərimizi idarə etməyin həyəcanını yaşayın.',
                'value_en' => 'Experience the thrill of driving our top-of-the-line cars.',
                'value_ru' => 'Почувствуйте драйв за рулем наших лучших автомобилей.'],
            ['key' => 'home.why_3_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 3 title', 'sort_order' => 80,
                'value_az' => 'Pulsuz ləğv', 'value_en' => 'Free Cancelation', 'value_ru' => 'Бесплатная отмена'],
            ['key' => 'home.why_3_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 3 text', 'sort_order' => 90,
                'value_az' => 'Planlarınız dəyişərsə, pulsuz ləğv imkanından istifadə edin.',
                'value_en' => 'Enjoy the flexibility of free cancellation if your plans change.',
                'value_ru' => 'Если планы изменились — отмените бесплатно.'],
            ['key' => 'home.why_4_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 4 title', 'sort_order' => 100,
                'value_az' => 'Ən yaxşı qiymət', 'value_en' => 'Best Price', 'value_ru' => 'Лучшая цена'],
            ['key' => 'home.why_4_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 4 text', 'sort_order' => 110,
                'value_az' => 'İcarə avtomobilləri üçün ən yaxşı qiymətləri təmin edirik.',
                'value_en' => 'We guarantee the best prices for our rental cars.',
                'value_ru' => 'Мы гарантируем лучшие цены на аренду.'],
            ['key' => 'home.why_5_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 5 title', 'sort_order' => 120,
                'value_az' => 'Asan proses', 'value_en' => 'Easy Process', 'value_ru' => 'Простой процесс'],
            ['key' => 'home.why_5_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 5 text', 'sort_order' => 130,
                'value_az' => 'Prosesimiz avtomobil icarəsini sürətli və rahat edir.',
                'value_en' => 'Our process makes renting a car quick and effortless.',
                'value_ru' => 'Аренда автомобиля у нас быстрая и простая.'],
            ['key' => 'home.why_6_title', 'group' => 'home_why', 'type' => 'text', 'label' => 'Feature 6 title', 'sort_order' => 140,
                'value_az' => 'Rəqəmsal xidmətlər', 'value_en' => 'Digital services', 'value_ru' => 'Цифровые сервисы'],
            ['key' => 'home.why_6_text', 'group' => 'home_why', 'type' => 'textarea', 'label' => 'Feature 6 text', 'sort_order' => 150,
                'value_az' => 'Daha rahat icarə üçün rəqəmsal xidmətlərimizdən istifadə edin.',
                'value_en' => 'Use our digital services for a more convenient rental experience.',
                'value_ru' => 'Используйте цифровые сервисы для удобной аренды.'],
            ['key' => 'home.footer_image', 'group' => 'home_why', 'type' => 'image', 'label' => 'Home bottom image', 'sort_order' => 160,
                'value_az' => '/images/orange car 1.png', 'value_en' => '/images/orange car 1.png', 'value_ru' => '/images/orange car 1.png'],

            // Contact
            ['key' => 'contact.intro', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Contact intro', 'sort_order' => 10,
                'value_az' => 'Rezervasiya, ödəniş və ya maşın haqqında sualınız var? Bizə yazın.',
                'value_en' => 'Got a question about a reservation, a payment, or a car? Let us know.',
                'value_ru' => 'Вопрос по бронированию, оплате или автомобилю? Напишите нам.'],
            ['key' => 'contact.company_name', 'group' => 'contact', 'type' => 'text', 'label' => 'Company name', 'sort_order' => 20,
                'value_az' => 'RealRentCar LLC', 'value_en' => 'RealRentCar LLC', 'value_ru' => 'RealRentCar LLC'],
            ['key' => 'contact.company_location', 'group' => 'contact', 'type' => 'text', 'label' => 'Company location line', 'sort_order' => 30,
                'value_az' => 'Ünvan: Azərbaycan', 'value_en' => 'Location: Azerbaijan', 'value_ru' => 'Локация: Азербайджан'],
            ['key' => 'contact.address_line', 'group' => 'contact', 'type' => 'text', 'label' => 'Address', 'sort_order' => 40,
                'value_az' => 'Bakı, Azərbaycan', 'value_en' => 'Baku, Azerbaijan', 'value_ru' => 'Баку, Азербайджан'],
            ['key' => 'contact.postal_code', 'group' => 'contact', 'type' => 'text', 'label' => 'Postal code line', 'sort_order' => 50,
                'value_az' => 'Poçt kodu: AZ1000', 'value_en' => 'Zip Code/Postal code: AZ1000', 'value_ru' => 'Почтовый индекс: AZ1000'],
            ['key' => 'contact.phone_text', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Call us text', 'sort_order' => 60,
                'value_az' => 'Komandamızla danışmaq üçün zəng edin. Həmişə kömək etməyə hazırıq.',
                'value_en' => 'Call us to speak to a member of our team. We are always happy to help.',
                'value_ru' => 'Позвоните, чтобы связаться с нашей командой. Мы всегда рады помочь.'],
            ['key' => 'contact.phone', 'group' => 'contact', 'type' => 'text', 'label' => 'Phone number', 'sort_order' => 70,
                'value_az' => '+994500000000', 'value_en' => '+994500000000', 'value_ru' => '+994500000000'],
            ['key' => 'contact.email', 'group' => 'contact', 'type' => 'text', 'label' => 'Contact email', 'sort_order' => 80,
                'value_az' => 'realrentcar@email.com', 'value_en' => 'realrentcar@email.com', 'value_ru' => 'realrentcar@email.com'],

            // Social
            ['key' => 'social.facebook', 'group' => 'social', 'type' => 'url', 'label' => 'Facebook URL', 'sort_order' => 10,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.instagram', 'group' => 'social', 'type' => 'url', 'label' => 'Instagram URL', 'sort_order' => 20,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.whatsapp', 'group' => 'social', 'type' => 'url', 'label' => 'WhatsApp URL', 'sort_order' => 30,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.telegram', 'group' => 'social', 'type' => 'url', 'label' => 'Telegram URL', 'sort_order' => 40,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.youtube', 'group' => 'social', 'type' => 'url', 'label' => 'YouTube URL', 'sort_order' => 50,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.tiktok', 'group' => 'social', 'type' => 'url', 'label' => 'TikTok URL', 'sort_order' => 60,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.linkedin', 'group' => 'social', 'type' => 'url', 'label' => 'LinkedIn URL', 'sort_order' => 70,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],
            ['key' => 'social.x', 'group' => 'social', 'type' => 'url', 'label' => 'X (Twitter) URL', 'sort_order' => 80,
                'value_az' => '', 'value_en' => '', 'value_ru' => ''],

            // Location
            ['key' => 'location.text_1', 'group' => 'location', 'type' => 'textarea', 'label' => 'Location paragraph 1', 'sort_order' => 10,
                'value_az' => 'Şəhərin mərkəzində yerləşən avtomobil icarəsi məntəqəmizə xoş gəlmisiniz. Ünvan həm yerli sakinlər, həm də səyahətçilər üçün rahatdır.',
                'value_en' => 'Welcome to our car rental shop in the heart of the city. The location is easy to reach for both residents and travelers.',
                'value_ru' => 'Добро пожаловать в наш пункт аренды в центре города. Сюда удобно добраться и жителям, и туристам.'],
            ['key' => 'location.text_2', 'group' => 'location', 'type' => 'textarea', 'label' => 'Location paragraph 2', 'sort_order' => 20,
                'value_az' => 'Məntəqə əsas nəqliyyat qovşaqlarına yaxındır, ona görə təhvil-təslim asandır. İşçilərimiz sizi qarşılayıb prosesi rahat keçirəcək.',
                'value_en' => 'The shop is close to major transport hubs, so pickup and drop-off stay simple. Our staff will greet you and keep the rental process smooth.',
                'value_ru' => 'Пункт рядом с транспортными узлами, поэтому выдача и возврат просты. Сотрудники встретят вас и помогут.'],
            ['key' => 'location.text_3', 'group' => 'location', 'type' => 'textarea', 'label' => 'Location paragraph 3', 'sort_order' => 30,
                'value_az' => 'Ətrafda restoran, kafe və mağazalar var — icarədən əvvəl və sonra rahat istifadə edə bilərsiniz.',
                'value_en' => 'The neighborhood has restaurants, cafes, and shops a short distance away, useful before or after your rental.',
                'value_ru' => 'Рядом есть рестораны, кафе и магазины — удобно до и после аренды.'],
            ['key' => 'location.text_4', 'group' => 'location', 'type' => 'textarea', 'label' => 'Location paragraph 4', 'sort_order' => 40,
                'value_az' => 'Yerində parkinq var, öz maşınınızı qoyub icarə avtomobili ilə yola düşə bilərsiniz.',
                'value_en' => 'Parking is available on site, so you can leave your own car and drive away in the rental.',
                'value_ru' => 'На месте есть парковка: оставьте свое авто и уезжайте на арендованном.'],
            ['key' => 'location.image_1', 'group' => 'location', 'type' => 'image', 'label' => 'Location image 1', 'sort_order' => 50,
                'value_az' => '/images/shop1.png', 'value_en' => '/images/shop1.png', 'value_ru' => '/images/shop1.png'],
            ['key' => 'location.image_2', 'group' => 'location', 'type' => 'image', 'label' => 'Location image 2', 'sort_order' => 60,
                'value_az' => '/images/shop_2.jpg', 'value_en' => '/images/shop_2.jpg', 'value_ru' => '/images/shop_2.jpg'],
            ['key' => 'location.map_embed', 'group' => 'location', 'type' => 'url', 'label' => 'Google Maps embed URL', 'sort_order' => 70,
                'value_az' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.9188930414984!2d-8.984100424763344!3d29.722108575087578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb6b1b1966dcdef%3A0x2bf9c55ec4ef96f9!2sIsta%20Tafraout!5e0!3m2!1sen!2sma!4v1686498234799!5m2!1sen!2sma',
                'value_en' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.9188930414984!2d-8.984100424763344!3d29.722108575087578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb6b1b1966dcdef%3A0x2bf9c55ec4ef96f9!2sIsta%20Tafraout!5e0!3m2!1sen!2sma!4v1686498234799!5m2!1sen!2sma',
                'value_ru' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.9188930414984!2d-8.984100424763344!3d29.722108575087578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb6b1b1966dcdef%3A0x2bf9c55ec4ef96f9!2sIsta%20Tafraout!5e0!3m2!1sen!2sma!4v1686498234799!5m2!1sen!2sma'],
        ];

        foreach ($settings as $row) {
            SiteSetting::updateOrCreate(['key' => $row['key']], $row);
        }

        $privacyEn = <<<'HTML'
<p>RealRentCar ("we," "us," or "our") operates the RealRentCar website and app ("Platform"). This Privacy Policy outlines how we collect, use, and disclose personal information from users of the Platform. By accessing and using our Platform, you consent to the practices described in this Privacy Policy.</p>
<h3>Information Collection and Use</h3>
<p>a. Personal Information: We may collect personal information from users, including but not limited to name, address, phone number, email address, driving license details, payment information, and other information required to process car rental reservations and transactions.</p>
<p>b. Usage Data: We automatically collect certain information about your device, such as IP address, browser type, operating system, and browsing activity, to improve our Platform and user experience.</p>
<p>c. Cookies and Tracking Technologies: We use cookies and similar technologies to track user interactions on the Platform and provide personalized content.</p>
<h3>Data Security</h3>
<p>We implement reasonable security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, no data transmission over the internet or electronic storage method is entirely secure, and we cannot guarantee absolute data security.</p>
<h3>Data Retention</h3>
<p>We will retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy and comply with legal requirements.</p>
<h3>Third-Party Services</h3>
<p>We may use third-party services, such as payment processors and analytics providers, to facilitate Platform operations. These third-party services have their own privacy policies and terms of use, which are separate from ours. We recommend reviewing their policies before interacting with these services.</p>
<h3>User Rights</h3>
<p>You have the right to access, update, correct, or delete your personal information. If you wish to exercise these rights, please contact us using the contact information provided on our Contact page.</p>
HTML;

        $termsEn = <<<'HTML'
<h3>Acceptance of Terms</h3>
<p>By using our Platform, you agree to comply with these Terms &amp; Conditions. If you do not agree with any part of these terms, you must refrain from using the Platform.</p>
<h3>Car Rental Reservations</h3>
<p>a. Eligibility: To make a car rental reservation, you must be of legal age and possess a valid driver's license.</p>
<p>b. Rental Charges: Rental charges, including taxes, fees, and insurance costs, will be displayed during the reservation process. You are responsible for paying all applicable charges.</p>
<h3>User Conduct</h3>
<p>a. You agree not to use the Platform for any illegal, harmful, or unauthorized purposes.</p>
<p>b. You agree not to interfere with the Platform's operation or attempt to gain unauthorized access to its systems or data.</p>
<h3>Limitation of Liability</h3>
<p>We shall not be liable for any damages, losses, or expenses arising from your use of the Platform or car rental services, including but not limited to accidents, property damage, or personal injuries.</p>
<h3>Modifications and Termination</h3>
<p>We reserve the right to modify or terminate the Platform, services, and these Terms &amp; Conditions at any time without prior notice.</p>
<h3>Governing Law</h3>
<p>These Terms &amp; Conditions shall be governed by and construed in accordance with the laws of Azerbaijan.</p>
<h3>Contact Us</h3>
<p>If you have any questions or concerns about our Privacy Policy or Terms &amp; Conditions, please contact us at: realrentcar@email.com</p>
HTML;

        Page::updateOrCreate(['slug' => 'privacy_policy'], [
            'title_az' => 'Məxfilik siyasəti',
            'title_en' => 'Privacy Policy',
            'title_ru' => 'Политика конфиденциальности',
            'body_az' => $privacyEn,
            'body_en' => $privacyEn,
            'body_ru' => $privacyEn,
        ]);

        Page::updateOrCreate(['slug' => 'terms_conditions'], [
            'title_az' => 'Şərtlər və Qaydalar',
            'title_en' => 'Terms & Conditions',
            'title_ru' => 'Условия использования',
            'body_az' => $termsEn,
            'body_en' => $termsEn,
            'body_ru' => $termsEn,
        ]);

        SiteSetting::clearCache();
    }
}
