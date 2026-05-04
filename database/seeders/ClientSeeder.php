<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('clients')->truncate();
        DB::table('projects')->truncate();
        DB::table('client_activities')->truncate();
        DB::table('client_documents')->truncate();
        Schema::enableForeignKeyConstraints();

        $userId = 1;

        $clients = [
            [
                'name' => 'Sarah Jenkins',
                'email' => 'sarah.j@lumina.io',
                'phone' => '+1 (555) 123-4567',
                'company' => 'Lumina Design',
                'company_name' => 'Lumina Design',
                'address' => '450 Innovation Blvd, San Francisco, CA 94105',
                'website' => 'https://lumina.io',
                'tier' => 'premium',
                'status' => 'active',
                'total_revenue' => 128400.00,
                'location' => 'San Francisco, CA',
                'avatar_url' => 'https://ui-avatars.com/api/?name=SJ&background=818cf8&color=fff&size=128',
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Marcus Thornton',
                'email' => 'm.thornton@vector.com',
                'phone' => '+1 (555) 234-5678',
                'company' => 'Vector Global',
                'company_name' => 'Vector Global',
                'address' => '789 Commerce Ave, New York, NY 10001',
                'website' => 'https://vector.com',
                'tier' => 'standard',
                'status' => 'active',
                'total_revenue' => 45200.00,
                'location' => 'New York, NY',
                'avatar_url' => 'https://ui-avatars.com/api/?name=MT&background=a5b4fc&color=fff&size=128',
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Elena Ross',
                'email' => 'elena@skyline.dev',
                'phone' => '+1 (555) 345-6789',
                'company' => 'Skyline Dev',
                'company_name' => 'Skyline Development Corp',
                'address' => '321 Tech Park Drive, Austin, TX 78701',
                'website' => 'https://skyline.dev',
                'tier' => 'basic',
                'status' => 'archived',
                'total_revenue' => 12000.00,
                'location' => 'Austin, TX',
                'avatar_url' => 'https://ui-avatars.com/api/?name=ER&background=94a3b8&color=fff&size=128',
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'Julian Banks',
                'email' => 'julian@apex.media',
                'phone' => '+1 (555) 456-7890',
                'company' => 'Apex Media',
                'company_name' => 'Apex Media Group',
                'address' => '555 Media Lane, Los Angeles, CA 90028',
                'website' => 'https://apex.media',
                'tier' => 'premium',
                'status' => 'active',
                'total_revenue' => 92750.00,
                'location' => 'Los Angeles, CA',
                'avatar_url' => 'https://ui-avatars.com/api/?name=JB&background=ffb783&color=1e1b4b&size=128',
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'name' => 'David Miller',
                'email' => 'david@vanguard.io',
                'phone' => '+1 (555) 567-8901',
                'company' => 'Vanguard Dynamics',
                'company_name' => 'Vanguard Dynamics Inc',
                'address' => '999 Industrial Way, Chicago, IL 60601',
                'website' => 'https://vanguard.io',
                'tier' => 'premium',
                'status' => 'active',
                'total_revenue' => 185000.00,
                'location' => 'Chicago, IL',
                'avatar_url' => 'https://ui-avatars.com/api/?name=DM&background=34d399&color=fff&size=128',
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
        ];

        $clientIds = [];
        foreach ($clients as $client) {
            $clientIds[] = DB::table('clients')->insertGetId($client);
        }

        $projects = [
            [
                'client_id' => $clientIds[0],
                'name' => 'Neo-Transit Hub',
                'description' => 'Global logistics infrastructure upgrade for Lumina Design',
                'status' => 'active',
                'priority' => 'high',
                'start_date' => '2024-06-01',
                'end_date' => '2024-10-24',
                'budget' => 45000.00,
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'client_id' => $clientIds[0],
                'name' => 'Brand Refresh 2024',
                'description' => 'Complete brand identity overhaul',
                'status' => 'completed',
                'priority' => 'medium',
                'start_date' => '2024-01-15',
                'end_date' => '2024-04-30',
                'budget' => 28000.00,
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'client_id' => $clientIds[1],
                'name' => 'E-Commerce Platform',
                'description' => 'Full e-commerce solution for Vector Global',
                'status' => 'active',
                'priority' => 'high',
                'start_date' => '2024-07-01',
                'end_date' => '2024-11-12',
                'budget' => 35000.00,
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'client_id' => $clientIds[3],
                'name' => 'Media Campaign Q4',
                'description' => 'Multi-channel marketing campaign',
                'status' => 'paused',
                'priority' => 'medium',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-15',
                'budget' => 52000.00,
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
            [
                'client_id' => $clientIds[4],
                'name' => 'Logistics Integration',
                'description' => 'Automated supply chain systems',
                'status' => 'active',
                'priority' => 'urgent',
                'start_date' => '2024-05-15',
                'end_date' => '2024-10-30',
                'budget' => 95000.00,
                'created_by' => $userId,
                'updated_by' => $userId,
            ],
        ];

        $projectIds = [];
        foreach ($projects as $project) {
            $projectIds[] = DB::table('projects')->insertGetId($project);
        }

        $activities = [
            [
                'client_id' => $clientIds[0],
                'description' => 'New retainer agreement signed',
                'type' => 'contract',
                'user_id' => $userId,
                'created_by' => $userId,
            ],
            [
                'client_id' => $clientIds[1],
                'description' => 'Payment received for Project Alpha',
                'type' => 'payment',
                'user_id' => $userId,
                'created_by' => $userId,
            ],
            [
                'client_id' => $clientIds[2],
                'description' => 'Account flagged for review - payment issue',
                'type' => 'flag',
                'user_id' => $userId,
                'created_by' => $userId,
            ],
            [
                'client_id' => $clientIds[3],
                'description' => 'Project milestone completed: Phase 1',
                'type' => 'milestone',
                'user_id' => $userId,
                'created_by' => $userId,
            ],
            [
                'client_id' => $clientIds[4],
                'description' => 'Document uploaded: Q4 Strategy Report',
                'type' => 'document',
                'user_id' => $userId,
                'created_by' => $userId,
            ],
        ];

        foreach ($activities as $activity) {
            DB::table('client_activities')->insert($activity);
        }

        $documents = [
            [
                'client_id' => $clientIds[0],
                'title' => 'Q4_Operational_Strategy_V2.pdf',
                'description' => 'Strategic planning document',
                'file_id' => null,
                'uploaded_by' => $userId,
            ],
            [
                'client_id' => $clientIds[0],
                'title' => 'Financial_Projections_2024.xlsx',
                'description' => 'Annual financial projections',
                'file_id' => null,
                'uploaded_by' => $userId,
            ],
            [
                'client_id' => $clientIds[1],
                'title' => 'Service_Agreement.docx',
                'description' => 'Master service agreement',
                'file_id' => null,
                'uploaded_by' => $userId,
            ],
            [
                'client_id' => $clientIds[4],
                'title' => 'Brand_Guidelines.pdf',
                'description' => 'Official brand guidelines',
                'file_id' => null,
                'uploaded_by' => $userId,
            ],
        ];

        foreach ($documents as $doc) {
            DB::table('client_documents')->insert($doc);
        }

        $this->command->info('Seeded 5 clients, 5 projects, 5 activities, and 4 documents.');
    }
}