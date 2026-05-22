<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LookupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Clear existing data to avoid duplicate key issues on reseeding
            DB::table('competency_schemes')->delete();
            DB::table('campuses')->delete();
            DB::table('iscos')->delete();
            DB::table('isics')->delete();

            // 2. Seed ISCO Codes
            $iscosPath = database_path('data/iscos.json');
            if (File::exists($iscosPath)) {
                $iscos = json_decode(File::get($iscosPath), true);
                
                $iscoChunks = array_chunk($iscos, 100);
                foreach ($iscoChunks as $chunk) {
                    $insertData = [];
                    foreach ($chunk as $item) {
                        $insertData[] = [
                            'level' => $item['level'],
                            'code' => $item['code'],
                            'title_en' => $item['title_en'] ?? null,
                            'title_id' => $item['title_id'] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    DB::table('iscos')->insert($insertData);
                }
                $this->command->info('Seeded ' . count($iscos) . ' ISCO codes.');
            } else {
                $this->command->error('iscos.json not found at ' . $iscosPath);
            }

            // 3. Seed ISIC Codes
            $isicsPath = database_path('data/isics.json');
            if (File::exists($isicsPath)) {
                $isics = json_decode(File::get($isicsPath), true);
                
                $insertData = [];
                foreach ($isics as $item) {
                    $insertData[] = [
                        'code' => $item['code'],
                        'title_en' => $item['title_en'] ?? null,
                        'title_id' => $item['title_id'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                DB::table('isics')->insert($insertData);
                $this->command->info('Seeded ' . count($isics) . ' ISIC codes.');
            } else {
                $this->command->error('isics.json not found at ' . $isicsPath);
            }

            // 4. Seed Campus & Competency Schemes
            $schemesPath = database_path('data/campus_schemes.json');
            if (File::exists($schemesPath)) {
                $campuses = json_decode(File::get($schemesPath), true);
                
                $campusCount = 0;
                $schemeCount = 0;
                
                foreach ($campuses as $campusData) {
                    $campusName = $campusData['campus'];
                    $schemes = $campusData['schemes'];
                    
                    // Insert Campus
                    $campusId = DB::table('campuses')->insertGetId([
                        'name' => $campusName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $campusCount++;
                    
                    if (!empty($schemes)) {
                        $schemeInsertData = [];
                        foreach ($schemes as $schemeName) {
                            $schemeInsertData[] = [
                                'campus_id' => $campusId,
                                'name' => $schemeName,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                            $schemeCount++;
                        }
                        
                        // Bulk insert schemes in chunks of 50 to be safe
                        $schemeChunks = array_chunk($schemeInsertData, 50);
                        foreach ($schemeChunks as $chunk) {
                            DB::table('competency_schemes')->insert($chunk);
                        }
                    }
                }
                $this->command->info("Seeded {$campusCount} Campuses and {$schemeCount} Competency Schemes.");
            } else {
                $this->command->error('campus_schemes.json not found at ' . $schemesPath);
            }
        });
    }
}
