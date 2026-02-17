<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ─── Umum ──────────────────────────────────────────────
            [
                'key' => 'site_name',
                'value' => 'Masjid Bukit Palma',
                'group' => 'umum',
                'label' => 'Nama Situs',
                'type' => 'text',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Membangun Kepercayaan Jamaah Melalui Transparansi Digital',
                'group' => 'umum',
                'label' => 'Tagline',
                'type' => 'text',
            ],

            // ─── Kontak ────────────────────────────────────────────
            [
                'key' => 'site_email',
                'value' => 'info@masjidbukitpalma.or.id',
                'group' => 'kontak',
                'label' => 'Email',
                'type' => 'email',
            ],
            [
                'key' => 'site_phone',
                'value' => '-',
                'group' => 'kontak',
                'label' => 'Telepon',
                'type' => 'text',
            ],
            [
                'key' => 'site_address',
                'value' => 'Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia',
                'group' => 'kontak',
                'label' => 'Alamat Lengkap',
                'type' => 'textarea',
            ],
            [
                'key' => 'office_hours',
                'value' => json_encode([
                    [
                        'day_start' => 'Senin',
                        'day_end' => 'Jumat',
                        'time_open' => '08:00',
                        'time_close' => '16:00',
                        'is_closed' => false,
                    ],
                    [
                        'day_start' => 'Sabtu',
                        'day_end' => 'Minggu',
                        'time_open' => '09:00',
                        'time_close' => '12:00',
                        'is_closed' => false,
                    ]
                ]),
                'group' => 'kontak',
                'label' => 'Jam Operasional Sekretariat',
                'type' => 'json', // Custom type marker
            ],
            [
                'key' => 'google_maps_embed',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1246.6613938901298!2d112.63133341697875!3d-7.2518304480149975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd1f418e5313%3A0xe254b11ad976f38c!2sMasjid%20Raya%20Bukit%20Palma%20Surabaya%20Barat!5e0!3m2!1sen!2sid!4v1771187023598!5m2!1sen!2sid',
                'group' => 'kontak',
                'label' => 'Google Maps Embed URL',
                'type' => 'url',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
            ['key' => $setting['key']],
                $setting
            );
        }

        // Seed Social Links
        $socials = [
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/masjidbukit.palma', 'label' => '@masjidbukit.palma'],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com/@masjidbukit.palma', 'label' => 'Masjid Bukit Palma'],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/masjidbukit.palma', 'label' => 'Masjid Bukit Palma'],
            ['platform' => 'WhatsApp', 'url' => 'https://wa.me/6281234567800', 'label' => 'Chat WhatsApp'],
        ];

        foreach ($socials as $index => $social) {
            \App\Models\SocialLink::firstOrCreate(
            ['platform' => $social['platform']],
                array_merge($social, ['sort_order' => $index])
            );
        }
    }
}
