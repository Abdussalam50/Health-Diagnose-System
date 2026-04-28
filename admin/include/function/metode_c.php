<?php
/**
 * Class C45DiagnosticSystem
 * 
 * Implementasi algoritma C4.5 yang ditingkatkan untuk klasifikasi diagnosa pasien
 * berdasarkan tekanan darah, detak jantung, dan suhu tubuh.
 * Versi ini mengimplementasikan pembangunan pohon keputusan secara dinamis.
 */
class C45DiagnosticSystem {
    /**
     * Data training yang digunakan dalam algoritma
     * @var array
     */
    private $trainingData;
    
    /**
     * Pohon keputusan yang dihasilkan
     * @var array
     */
    private $decisionTree;
    
    /**
     * Daftar atribut yang digunakan
     * @var array
     */
    private $attributes = ['tekanan_darah', 'detak_jantung', 'suhu_tubuh'];
    
    /**
     * Konstruktor kelas
     * @param array $data Data training (opsional)
     */
    public function __construct($data = []) {
        $this->trainingData = $data;
        $this->decisionTree = null;
    }
    
    /**
     * Menetapkan data training
     * 
     * @param array $dataset Data training baru
     */
    public function setData($dataset) {
        $this->trainingData = $dataset;
        // Reset pohon keputusan ketika data berubah
        $this->decisionTree = null;
    }
    
    /**
     * Menghitung entropy dari sebuah dataset
     * 
     * @param array $dataset Data yang akan dihitung entropy-nya
     * @return float Nilai entropy
     */
    public function calculateEntropy($dataset) {
        $totalData = count($dataset);
        if ($totalData === 0) {
            return 0;
        }
        
        // Menghitung jumlah kemunculan setiap kelas
        $kondisiCounts = [];
        foreach ($dataset as $data) {
            $kondisi = $data['kondisi'];
            if (!isset($kondisiCounts[$kondisi])) {
                $kondisiCounts[$kondisi] = 0;
            }
            $kondisiCounts[$kondisi]++;
        }
        
        // Menghitung entropy
        $entropy = 0;
        foreach ($kondisiCounts as $count) {
            $probability = $count / $totalData;
            $entropy -= $probability * log($probability, 2);
        }
        
        return $entropy;
    }
    
    /**
     * Menghitung information gain untuk sebuah atribut
     * 
     * @param array $dataset Data yang akan dihitung gain-nya
     * @param string $attribute Atribut yang akan dihitung gain-nya
     * @return float Nilai information gain
     */
    public function calculateGain($dataset, $attribute) {
        $totalData = count($dataset);
        $entropy = $this->calculateEntropy($dataset);
        
        // Membagi dataset berdasarkan nilai atribut
        $attributeValues = [];
        foreach ($dataset as $data) {
            $value = $this->getAttributeCategory($data, $attribute);
            if (!isset($attributeValues[$value])) {
                $attributeValues[$value] = [];
            }
            $attributeValues[$value][] = $data;
        }
        
        // Menghitung entropy untuk setiap nilai atribut
        $entropySum = 0;
        foreach ($attributeValues as $value => $subDataset) {
            $subEntropy = $this->calculateEntropy($subDataset);
            $probability = count($subDataset) / $totalData;
            $entropySum += $probability * $subEntropy;
        }
        
        // Menghitung information gain
        $gain = $entropy - $entropySum;
        
        return $gain;
    }
    
    /**
     * Mendapatkan kategori untuk atribut tertentu
     * 
     * @param array $data Data pasien
     * @param string $attribute Nama atribut
     * @return string Kategori atribut
     */
    public function getAttributeCategory($data, $attribute) {
        switch ($attribute) {
            case 'tekanan_darah':
                if ($data['tekanan_sistolik'] >= 130) {
                    return 'Tinggi';
                } elseif ($data['tekanan_sistolik'] >= 110) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            case 'detak_jantung':
                if ($data['detak_jantung'] >= 100) {
                    return 'Tinggi';
                } elseif ($data['detak_jantung'] >= 60) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            case 'suhu_tubuh':
                if ($data['suhu_tubuh'] >= 38.0) {
                    return 'Tinggi';
                } elseif ($data['suhu_tubuh'] >= 36.5) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            default:
                return 'Unknown';
        }
    }
    
    /**
     * Mendapatkan kategori atribut untuk data baru (bukan dari dataset)
     * 
     * @param string $attribute Nama atribut
     * @param mixed $value Nilai atribut
     * @return string Kategori atribut
     */
    public function getCategoryForValue($attribute, $value) {
        switch ($attribute) {
            case 'tekanan_darah':
                if ($value >= 130) {
                    return 'Tinggi';
                } elseif ($value >= 110) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            case 'detak_jantung':
                if ($value >= 100) {
                    return 'Tinggi';
                } elseif ($value >= 60) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            case 'suhu_tubuh':
                if ($value >= 38.0) {
                    return 'Tinggi';
                } elseif ($value >= 36.5) {
                    return 'Normal';
                } else {
                    return 'Rendah';
                }
                break;
                
            default:
                return 'Unknown';
        }
    }
    
    /**
     * Membangun pohon keputusan menggunakan algoritma C4.5
     * 
     * @param array $dataset Data training
     * @param array $attributes Daftar atribut yang tersedia
     * @param string $defaultClass Kelas default
     * @return array Pohon keputusan
     */
    public function buildDecisionTree($dataset = null, $attributes = null, $defaultClass = null) {
        // Inisialisasi parameter default
        if ($dataset === null) {
            $dataset = $this->trainingData;
        }
        if ($attributes === null) {
            $attributes = $this->attributes;
        }
        
        // Hitung jumlah data untuk setiap kelas
        $classCount = [];
        foreach ($dataset as $data) {
            $class = $data['kondisi'];
            if (!isset($classCount[$class])) {
                $classCount[$class] = 0;
            }
            $classCount[$class]++;
        }
        
        // Jika tidak ada data, kembalikan kelas default
        if (count($dataset) === 0) {
            return $defaultClass;
        }
        
        // Jika semua data memiliki kelas yang sama, kembalikan kelas tersebut
        if (count($classCount) === 1) {
            return array_keys($classCount)[0];
        }
        
        // Jika tidak ada atribut yang tersisa, kembalikan kelas mayoritas
        if (count($attributes) === 0) {
            arsort($classCount);
            return array_keys($classCount)[0];
        }
        
        // Hitung information gain untuk setiap atribut
        $gains = [];
        foreach ($attributes as $attribute) {
            $gains[$attribute] = $this->calculateGain($dataset, $attribute);
        }
        
        // Pilih atribut dengan information gain tertinggi
        arsort($gains);
        $bestAttribute = array_keys($gains)[0];
        
        // Buat node untuk pohon keputusan
        $tree = [
            'attribute' => $bestAttribute,
            'branches' => []
        ];
        
        // Hitung kelas mayoritas untuk default
        arsort($classCount);
        $defaultClass = array_keys($classCount)[0];
        
        // Bagi dataset berdasarkan nilai atribut terbaik
        $attrValues = [];
        foreach ($dataset as $data) {
            $value = $this->getAttributeCategory($data, $bestAttribute);
            if (!isset($attrValues[$value])) {
                $attrValues[$value] = [];
            }
            $attrValues[$value][] = $data;
        }
        
        // Kurangi daftar atribut (hapus yang terbaik)
        $newAttributes = array_diff($attributes, [$bestAttribute]);
        
        // Rekursi untuk setiap nilai atribut
        foreach ($attrValues as $value => $subset) {
            $subtree = $this->buildDecisionTree($subset, $newAttributes, $defaultClass);
            $tree['branches'][$value] = $subtree;
        }
        
        return $tree;
    }
    
    /**
     * Membangun dan menyimpan pohon keputusan untuk digunakan nanti
     */
    public function train() {
        $this->decisionTree = $this->buildDecisionTree();
        return $this->decisionTree;
    }
    
    /**
     * Menyimpan pohon keputusan ke file JSON
     * 
     * @param string $filename Nama file
     * @return bool Berhasil atau tidak
     */
    public function saveModelToFile($filename) {
        if ($this->decisionTree === null) {
            $this->train();
        }
        
        $json = json_encode($this->decisionTree, JSON_PRETTY_PRINT);
        return file_put_contents($filename, $json) !== false;
    }
    
    /**
     * Memuat pohon keputusan dari file JSON
     * 
     * @param string $filename Nama file
     * @return bool Berhasil atau tidak
     */
    public function loadModelFromFile($filename) {
        if (!file_exists($filename)) {
            return false;
        }
        
        $json = file_get_contents($filename);
        $this->decisionTree = json_decode($json, true);
        return $this->decisionTree !== null;
    }
    
    /**
     * Memprediksi kelas menggunakan pohon keputusan yang telah dibangun
     * 
     * @param array $tree Pohon keputusan
     * @param array $data Data yang akan diprediksi
     * @return string Hasil prediksi (diagnosa)
     */
    private function predict($tree, $data) {
        // Jika node adalah daun (string), kembalikan nilai
        if (!is_array($tree)) {
            return $tree;
        }
        
        // Ambil nilai atribut dari data
        $attribute = $tree['attribute'];
        $value = null;
        
        // Sesuaikan dengan jenis atribut
        switch ($attribute) {
            case 'tekanan_darah':
                $value = $this->getCategoryForValue($attribute, $data['tekanan_sistolik']);
                break;
            case 'detak_jantung':
                $value = $this->getCategoryForValue($attribute, $data['detak_jantung']);
                break;
            case 'suhu_tubuh':
                $value = $this->getCategoryForValue($attribute, $data['suhu_tubuh']);
                break;
        }
        
        // Jika nilai tidak ditemukan di pohon, cari nilai default
        if (!isset($tree['branches'][$value])) {
            // Cari kelas yang paling umum di cabang
            $counts = [];
            foreach ($tree['branches'] as $branch) {
                if (!is_array($branch)) {
                    if (!isset($counts[$branch])) {
                        $counts[$branch] = 0;
                    }
                    $counts[$branch]++;
                }
            }
            arsort($counts);
            return count($counts) > 0 ? array_keys($counts)[0] : "Tidak dapat diprediksi";
        }
        
        // Rekursi ke cabang yang sesuai
        return $this->predict($tree['branches'][$value], $data);
    }
    
    /**
     * Mendiagnosis pasien berdasarkan pohon keputusan yang dibangun
     * 
     * @param float $tekananSistolik Tekanan darah sistolik
     * @param int $detakJantung Detak jantung (bpm)
     * @param float $suhuTubuh Suhu tubuh (°C)
     * @return string Diagnosis pasien
     */
    public function diagnose($tekananSistolik, $detakJantung, $suhuTubuh) {
        // Pastikan pohon keputusan sudah dibangun
        if ($this->decisionTree === null) {
            $this->train();
        }
        
        // Buat data yang akan diprediksi
        $data = [
            'tekanan_sistolik' => $tekananSistolik,
            'detak_jantung' => $detakJantung,
            'suhu_tubuh' => $suhuTubuh
        ];
        
        // Prediksi menggunakan pohon keputusan
        return $this->predict($this->decisionTree, $data);
    }
    
    /**
     * Menghitung semua information gain
     * 
     * @return array Hasil perhitungan information gain
     */
    public function calculateAllGains() {
        $gains = [];
        foreach ($this->attributes as $attribute) {
            $gains[$attribute] = $this->calculateGain($this->trainingData, $attribute);
        }
        
        return $gains;
    }
    
    /**
     * Mendapatkan pohon keputusan yang telah dibangun
     * 
     * @return array Pohon keputusan
     */
    public function getDecisionTree() {
        if ($this->decisionTree === null) {
            $this->train();
        }
        return $this->decisionTree;
    }
    
    /**
     * Mendapatkan data training
     * 
     * @return array Data training
     */
    public function getTrainingData() {
        return $this->trainingData;
    }
    
    /**
     * Menampilkan pohon keputusan dalam format yang mudah dibaca
     * 
     * @param array $tree Pohon keputusan
     * @param int $level Level indentasi
     * @return string Representasi string dari pohon keputusan
     */
    public function printDecisionTree($tree = null, $level = 0) {
        if ($tree === null) {
            $tree = $this->decisionTree;
            if ($tree === null) {
                $this->train();
                $tree = $this->decisionTree;
            }
        }
        
        $output = "";
        $indent = str_repeat("|  ", $level);
        
        if (!is_array($tree)) {
            $output .= $indent . "=> " . $tree . "\n";
            return $output;
        }
        
        $attribute = $tree['attribute'];
        $output .= $indent . $attribute . "\n";
        
        foreach ($tree['branches'] as $value => $subtree) {
            $output .= $indent . "|--" . $value . "\n";
            $output .= $this->printDecisionTree($subtree, $level + 1);
        }
        
        return $output;
    }
}


// $data=[
//     [
//         'id' => 1,
//         'tekanan_darah' => '140/90',
//         'tekanan_sistolik' => 140,
//         'detak_jantung' => 85,
//         'suhu_tubuh' => 38.0,
//         'kondisi' => 'Hipertensi, Demam'
//     ],
//     [
//         'id' => 2,
//         'tekanan_darah' => '120/80',
//         'tekanan_sistolik' => 120,
//         'detak_jantung' => 75,
//         'suhu_tubuh' => 37.0,
//         'kondisi' => 'Sehat'
//     ],
//     [
//         'id' => 3,
//         'tekanan_darah' => '100/70',
//         'tekanan_sistolik' => 100,
//         'detak_jantung' => 60,
//         'suhu_tubuh' => 36.5,
//         'kondisi' => 'Hipotensi'
//     ],
//     [
//         'id' => 4,
//         'tekanan_darah' => '90/60',
//         'tekanan_sistolik' => 90,
//         'detak_jantung' => 55,
//         'suhu_tubuh' => 37.2,
//         'kondisi' => 'Bradikardia'
//     ],
//     [
//         'id' => 5,
//         'tekanan_darah' => '110/70',
//         'tekanan_sistolik' => 110,
//         'detak_jantung' => 120,
//         'suhu_tubuh' => 37.5,
//         'kondisi' => 'Takikardia'
//     ],
//     [
//         'id' => 6,
//         'tekanan_darah' => '130/85',
//         'tekanan_sistolik' => 130,
//         'detak_jantung' => 110,
//         'suhu_tubuh' => 38.5,
//         'kondisi' => 'Heat Exhaustion'
//     ]
//     ];
// $c45->setData($data);
// // Melatih model
// $c45->train();

// // Menyimpan model ke file JSON
// $c45->saveModelToFile('model_diagnosa.json');

// Kemudian, di lain waktu atau file lain, Anda dapat memuat model:
// $diagnoser = new C45DiagnosticSystem();
// if ($diagnoser->loadModelFromFile('model_diagnosa.json')) {
//     // Model berhasil dimuat, lakukan diagnosa
//     $tekananSistolik = 115.6;
//     $detakJantung = 76;
//     $suhuTubuh = 37.2;
    
//     $diagnosa = $diagnoser->diagnose($tekananSistolik, $detakJantung, $suhuTubuh);
//     echo "Diagnosa: " . $diagnosa;
// } else {
//     echo "Gagal memuat model!";
// }
?>