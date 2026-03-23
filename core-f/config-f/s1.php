<?php
$AppConfig = array (
        'db'                                   => array (
                'host'                         => 'localhost',
                'user'                         => '',
                'password'                     => '',
                'database'                     => '',
                   ),
                'Game'                         => array (		
				// اعدادات اللعبه
                'speed'                        => '100',//سرعة اللعبه
                'speed_t'                      => '100',//سرعه توقيت تدريب القوات
                'speed_b'                      => '100',//سرعه توقيت بناء المباني
                'dev_troop_to_20'              => '1000',//ذهب افران صهر الحديد بناء الى 20
                'WWW'                          => '100',//مضروب مووارد بناء المعجزه
                'WWW2'                         => '25',// مضروب توقيت بناء المعجزه
                'map'                          => '401',//حجم الخريطه
				'tid_npc'                      => '100',  ///مبادلة القوات بالسوق							
                'attack'                       => '30',//100سرعه الهجوم يفضل
                'protection'                   => '24',// الحمايه بالساعات
                'protectionx'                  => '0',//تدبيل الحمايه
                'X'                            => '1328827643',//غير مهم يرجى تركه هكذا
                'capacity'                     => '200', // المخازن يفضل 125
                'cranny'                       => '50', // المخابأ
                'cp'                           => '100',//ولاء القريه الجديده
                'market'                       => '50', // حمولة التجار
                'backtroops'        	       => '1000',		 // ارجاع التعزيزات
                'speedmarket'                  => '500', // سرعه التجار
                //البلاس
                'plus1'                        => '1',//مده بلاس بالايام
                'plus2'                        => '1',//مده الزياده بالايام
                'plus3'                        => '150',//قائمة بلاس
                'plus4'                        => '20',// زياده بلاس
                'plus5'                        => '5',//انهاء المباني فورأ
                'plus6'                        => '5',//تاجر مبادله
                'plus7'                        => '35',//انهاء تدريب القوات فورأ
                'plus9'                        => '1000',//انهاء التعزيزات فورأ
                'plus_by_abdullah_1_1'         => '1',  // المدة
                'plus_by_abdullah_1_2'         => '200', // +20% قوة الهجوم
                'plus_by_abdullah_2_1'         => '1', // المدة
                'plus_by_abdullah_2_2'         => '200', // +20% قوة الدفاع
                'plus_by_abdullah_3_1'         => '1', // المدة
                'plus_by_abdullah_3_2'         => '200', // +20% قوة المباني ضد المقاليع
                'plus_by_abdullah_4_1'         => '1', // المدة
                'plus_by_abdullah_4_2'         => '200', //+30% سرعة القوات
                'plus_by_abdullah_6_1'         => '1', // المدة
                'plus_by_abdullah_6_2'         => '100', // +20% زيادة حمولة القوات
                  
                  ///مميزات جديدة
                  'numpro'                     => '12',      //عدد ساعات حماية 
                 '8_cost'                     => '1000',      //تكلفة حماية بالذهب لكل مره 
                    'upes'                     => '15',      //عدد مرات شراء حماية 
                  'sooq'      => '1',      //ايقاف ارسال موارد 
                   'wa7at'     => '150', //زياددة عدد واحات خارطه 
 
                  
                  
                  

               
				//مميزات خاصة //
                'plus7_on'                     => '1',
                'activitebuyres'               => '0',// 1 شراء الموارد شغال 0 تعطيل
                'res'                          => '250000',// 1 شراء الموارد شغال 0 تعطيل
				'mkale'                        => '10', // المقاليع 10 للتشغيل 21 للايقاف
				'link'                         => '1',// ربح الذهب  1 يعمل 0 موقوف
				'copon'                        => '1',// كوبون الذهب 1 يعمل 0 موقوف
         


                //امـور عامه
                'pepolegold'                   => '1500',//سكان استلام الذهب لكسب الذهب
                'setgold'                      => '10000',//الذهب المعطى لكسب الذهب
                'bonous'                       => '200',//غير مهم
                'osas'                         => '75',// الواحات العاديه
                'osasX'                        => '150',// الواحات الكبيره القمح
                'online'                       => '222422',//المتصلين خروجهم بعد
                'freegold'                     => '250',//ذهب مجاني عند التسجيل
                'Warrior'                     => '0',//ذهب مجاني عند التسجيل

                'freegoldweek'                 => '0',//ذهب مجاني أسبوعي
                'awsmh'                        => '432000',// مده توزيع الاوسمه بالثواني 
                'RegisterOver'                 => '100',//مدة اغلاق التسجيل عدد الايام
        ),
        'page'                                 => array (
                'ar_title'                     => 'حرب التتار',
                'asset_version'                => 'Nhjkh1ka111alcMfks'
        ),
         'system'                               => array (
                'blocklistword'                => array( "goo.gl", "tatar4", "acunetix", "SomeCustomInjectedHeader", "0x31", "UNION", "' or", "NdcMasterLog", "
                game", "InstallGame", "iron-sy", "elaml.org", "lionab"),
                'adminName'                    => 'admin', //admin
                'adminPassword'                => '4297f44b13955235245b2497399d7a93',//باس الادمن

                'tatar'                        => '10',//مده نزول التتار بالايام
                'artef'                        => '8',//مده نزول التحف بالايام
                'start'                        => '',//مده العداد بالايام
                'endin'                        => '1',//مده اعاده سيرفر حرب التتار بالساعات
			    'server_days'           => '10',//وقت فتح السيرفر بالتاريخ ليكون فى رئيسية الموقع
				
			
				'moda'           => '10',//مدة السيرفر
				'tat'           => '10',//عدد ايام خروج التتار
				'wqt'           => '02/26/2023',//وقت بداء السيرفر
				'sasa'           => '10:00',//ساعة بداء السيرفر

                'lang'                         => 'ar',//اللغه
                'admin_email'                  => 'smartservs.com@gmail.com',//الايميل
                'webname'                      => 'حرب التتار',
                'email'                        => 'smartservs.com@gmail.com',//المرسل
                'namesite'                     => 'TATARWAR',//اسم الموقع انجليزي
                'linksite'                     => 'https://tatarwars-l-v1.smartservs.com/core-f/style-f/',//رابط الصور
                'installkey'                   => 'install9',//رمز التسطيب

),

       'plus'                                  => array (
                'packages'                     => array (

	array(

				'name'		=> 'الأولى',

				'gold'		=> 7000,


				'plus'		=> 0,

				'cost'		=> 15,


				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'الثانية',

				'gold'		=> 15000,


				'plus'		=> 0,

				'cost'		=> 29,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'الثالثة',

				'gold'		=> 31000,


				'plus'		=> 0,

				'cost'		=> 54,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'الرابعة',

				'gold'		=> 63240,


				'plus'		=> 2,

				'cost'		=> 101,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'الخامسة',

				'gold'		=> 127500,


				'plus'		=> 2,

				'cost'		=> 190,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'السادسة',

				'gold'		=> 250000,


				'plus'		=> 0,

				'cost'		=> 360,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'


			),
			array(

				'name'		=> 'السابعة',

				'gold'		=> 540000,


				'plus'		=> 8,

				'cost'		=> 570,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),

			array(

				'name'		=> 'الثامنة',

				'gold'		=> 1150000,

				'plus'		=> 15,

				'cost'		=> 1160,

				'currency'	=> 'ريال',

				'image'		=> 'package_a.webp'

			),


		),

                'payments'                     => array (

                        'paypal'               => array (

                                'testMode'     => false,

                                'name'         => 'PayPal',
 
                                'image'        => 'PayPal-logo-1.webp',

				'merchant_id'	=> '',

				'currency'		=> 'USD'

                        ),
    
				    'edfapay'	=> array (
				'testMode'		=> false,
				'name'			=> 'Credit Card & Apple Pay',
				'image'			=> 'credit.png',
				'merchant_id'	=> '',
				'currency'		=> 'USD'
				)



                )

        )



);

?>