<?php
// Test script untuk debug JSON rendering issue

$secAbout = json_decode('{"note": "Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.", "image": "https://lh3.googleusercontent.com/aida-public/AB6AXuA5jkBzd0EqrT-cphGIkzHYDH2a7dpxzv95e4cWzjIaFRYe8B3poCp2NncsdrneEW_ldLWrzvbO4JcdyzzGiQ-Mvb33B6kEHzU80DleUBPVkvlrCikONCi2W8yS5aMmee0S50iv_AYi1wUI-pnY1lPSKs2H7rnAXGxAPLvpZ9j5QBG9pWjHTb3FiXnNHZa6j5uJnKPdjulHepAKqk6Eb1zivof6CfMQt0IRObJoQROAn60P6jzRyfcrAQ", "label": "SEKILAS DHS", "headline": "Transformasi Menuju Unggul.", "paragraph1": "Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.", "paragraph2": "Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri."}', true);

echo "Testing JSON rendering:\n\n";

echo "p1: " . json_encode($secAbout['paragraph1'] ?? 'default p1') . "\n";
echo "p2: " . json_encode($secAbout['paragraph2'] ?? 'default p2') . "\n";
echo "note: " . json_encode($secAbout['note'] ?? 'default note') . "\n";

echo "\n\nFull JavaScript object syntax test:\n";
echo "about: {\n";
echo "    p1: " . json_encode($secAbout['paragraph1'] ?? 'default') . ",\n";
echo "    p2: " . json_encode($secAbout['paragraph2'] ?? 'default') . ",\n";
echo "    note: " . json_encode($secAbout['note'] ?? 'default') . ",\n";
echo "}\n";

echo "\n\nChecking for special characters in paragraph2:\n";
$p2 = $secAbout['paragraph2'] ?? '';
echo "Length: " . strlen($p2) . "\n";
echo "Last 50 chars: " . substr($p2, -50) . "\n";
echo "Hex of last 10 chars: ";
$last10 = substr($p2, -10);
for ($i = 0; $i < strlen($last10); $i++) {
    echo dechex(ord($last10[$i])) . " ";
}
echo "\n";
