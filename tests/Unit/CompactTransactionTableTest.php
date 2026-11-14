<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CompactTransactionTableTest extends TestCase
{
    private function view(string $name): string
    {
        return file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/' . $name);
    }

    public function test_general_transaction_table_matches_screenshot_columns(): void
    {
        $content = $this->view('kas.blade.php');
        foreach (['KODE', 'TANGGAL', 'TIPE', 'PROGRAM', 'NOMINAL', 'METODE', 'STATUS', 'AKSI'] as $heading) {
            $this->assertStringContainsString($heading, strtoupper($content));
        }
    }

    public function test_finance_transaction_pages_use_compact_table_contract(): void
    {
        foreach (['kas.blade.php', 'kas-program.blade.php', 'kas-program-detail.blade.php'] as $view) {
            $content = $this->view($view);
            $this->assertStringContainsString('kas-transaction-table', $content, $view);
            $this->assertStringContainsString('aria-label=', $content, $view);
        }
    }

    public function test_transaction_tables_keep_actions_and_empty_state(): void
    {
        $kas = $this->view('kas.blade.php');
        $program = $this->view('kas-program.blade.php');
        $detail = $this->view('kas-program-detail.blade.php');

        $this->assertStringContainsString('x-on:click="openDetail(item)"', $kas);
        $this->assertStringContainsString('x-on:click="openModal(\'edit\', item)"', $kas);
        $this->assertStringContainsString('x-on:click="deleteItem(item.id)"', $kas);
        $this->assertStringContainsString('detailModal.item.is_piutang', $kas);
        $this->assertStringContainsString('detailModal.item.keterangan', $kas);
        $this->assertStringNotContainsString('title="Cetak"', $kas);
        $this->assertStringContainsString('summaryFiltered.persenMasuk', $kas);
        $this->assertStringContainsString('summaryFiltered.persenKeluar', $kas);
        $this->assertStringContainsString('summaryFiltered.persenPiutang', $kas);
        $form = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-transaction-form.blade.php');
        $this->assertStringContainsString('Tidak ada data transaksi', $kas);
        $this->assertStringContainsString('x-on:click="detailModal.open = true; detailModal.item = item"', $program);
        $this->assertStringContainsString('detailModal.item.is_piutang', $program);
        $this->assertStringContainsString('detailModal.item.keterangan', $program);
        $this->assertStringContainsString("openModal('edit', item)", $program);
        $this->assertStringNotContainsString('lunasPiutang(item)', $program);
        $this->assertStringNotContainsString('kas-piutang-pay-modal', $program);
        $this->assertStringContainsString('deleteItem(item.id)', $program);
        $this->assertStringContainsString('canCicil()', file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-transaction-form.blade.php'));
        $this->assertStringNotContainsString('Cetak Kwitansi', $program);
        $this->assertStringNotContainsString('lunasPiutang(item)', $kas);
        $this->assertStringNotContainsString('lunasPiutangById(', $kas);
        $this->assertStringNotContainsString('lunasPiutang(item)', $program);
        $this->assertStringNotContainsString('openPayPiutang(', $detail);
        $this->assertStringNotContainsString('kas-piutang-pay-modal', $detail);
        $this->assertStringContainsString('deleteTrx(', $detail);
        $this->assertStringContainsString('Belum ada riwayat', $detail);
    }

    public function test_payment_scheme_supports_lunas_and_dp_for_eligible_categories(): void
    {
        $form = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-transaction-form.blade.php');
        $helpers = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-helpers-js.blade.php');

        // Form must show scheme for piutang OR eligible income categories
        $this->assertStringContainsString("canCicil()", $form);
        $this->assertStringContainsString("setPaymentMode('lunas')", $form);
        $this->assertStringContainsString("setPaymentMode('cicil')", $form);
        $this->assertStringContainsString("Bayar Lunas", $form);
        $this->assertStringContainsString("Cicil / DP", $form);
        $this->assertStringContainsString("shouldShowPaymentScheme()", $form);
        $this->assertStringContainsString("Bayar Cicilan / Pelunasan Piutang", $form);
        $this->assertStringContainsString("Lunasi Penuh", $form);
        $this->assertStringContainsString("is_pending_piutang", $form);
        $this->assertStringContainsString("canCicil()", $helpers);
        $this->assertStringContainsString("shouldShowPaymentScheme()", $helpers);
        $this->assertStringContainsString("unitsList", $helpers);
    }

    public function test_export_pdf_feature_is_integrated_and_designed(): void
    {
        $filterBar = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-filter-bar.blade.php');
        $kas = $this->view('kas.blade.php');
        $program = $this->view('kas-program.blade.php');
        $routes = file_get_contents(dirname(__DIR__, 2) . '/routes/web.php');
        $pdfView = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/pdf/laporan-kas-pdf.blade.php');

        // Check filter bar button
        $this->assertStringContainsString('Export PDF', $filterBar);
        $this->assertStringContainsString(':href="exportPdfUrl()"', $filterBar);
        $this->assertStringContainsString('picture_as_pdf', $filterBar);

        // Check JS methods
        $this->assertStringContainsString('exportPdfUrl()', $kas);
        $this->assertStringContainsString('/backoffice/kas/export-pdf', $kas);
        $this->assertStringContainsString('exportPdfUrl()', $program);
        $this->assertStringContainsString('/backoffice/kas/export-pdf?category_id=', $program);

        // Check route
        $this->assertStringContainsString("Route::get('/backoffice/kas/export-pdf',             [BackofficeController::class, 'kasExportPdf']);", $routes);

        // Check PDF template design elements
        $this->assertStringContainsString('DENPASAR HOTEL SCHOOL', $pdfView);
        $this->assertStringContainsString('LAPORAN ARUS KAS & KEUANGAN', $pdfView);
        $this->assertStringContainsString('TOTAL PEMASUKAN', $pdfView);
        $this->assertStringContainsString('TOTAL PENGELUARAN', $pdfView);
        $this->assertStringContainsString('SISA PIUTANG (UANG LAPANGAN)', $pdfView);
        $this->assertStringContainsString('SELISIH BERSIH (SALDO)', $pdfView);
        $this->assertStringContainsString('Dibuat & Diverifikasi Oleh:', $pdfView);
        $this->assertStringContainsString('Mengetahui & Menyetujui:', $pdfView);
    }

    public function test_transaction_status_has_only_two_statuses_lunas_and_cicil(): void
    {
        $filterBar = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-filter-bar.blade.php');
        $helpers = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-helpers-js.blade.php');
        $kas = $this->view('kas.blade.php');
        $program = $this->view('kas-program.blade.php');
        $pdfView = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/pdf/laporan-kas-pdf.blade.php');

        // Filter bar status options: only 2 statuses (Lunas & Cicil)
        $this->assertStringContainsString('value="lunas"', $filterBar);
        $this->assertStringContainsString('value="cicil"', $filterBar);
        $this->assertStringNotContainsString('value="pemasukan"', $filterBar);
        $this->assertStringNotContainsString('value="pengeluaran"', $filterBar);

        // Helper getTransactionStatus
        $this->assertStringContainsString('getTransactionStatus(item)', $helpers);
        $this->assertStringContainsString("key: 'cicil'", $helpers);
        $this->assertStringContainsString("key: 'lunas'", $helpers);

        // Kas and Kas Program views use getTransactionStatus
        $this->assertStringContainsString('getTransactionStatus(item)', $kas);
        $this->assertStringContainsString('getTransactionStatus(item)', $program);

        // PDF table displays Lunas and Cicil
        $this->assertStringContainsString('Cicil', $pdfView);
        $this->assertStringContainsString('Lunas', $pdfView);
    }

    public function test_form_has_no_hp_and_keterangan_rich_text_and_whatsapp_cta(): void
    {
        $form = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-transaction-form.blade.php');
        $helpers = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-helpers-js.blade.php');
        $kas = $this->view('kas.blade.php');
        $program = $this->view('kas-program.blade.php');

        // Form has no_hp input and no separate deskripsi input
        $this->assertStringContainsString('name="no_hp"', $form);
        $this->assertStringNotContainsString('<input type="text" class="bo-input" name="deskripsi"', $form);
        $this->assertStringContainsString('name="keterangan"', $form);
        $this->assertStringContainsString('summernote-kas-keterangan', $form);

        // Helpers have getWhatsAppUrl and initSummernote
        $this->assertStringContainsString('getWhatsAppUrl(item)', $helpers);
        $this->assertStringContainsString('initSummernote(', $helpers);

        // Detail modals have WhatsApp CTA button
        $this->assertStringContainsString('getWhatsAppUrl(detailModal.item)', $kas);
        $this->assertStringContainsString('Hubungi via WhatsApp', $kas);
        $this->assertStringContainsString('getWhatsAppUrl(detailModal.item)', $program);
        $this->assertStringContainsString('Hubungi via WhatsApp', $program);
    }

    public function test_payment_method_input_and_program_transaction_direction_indicator(): void
    {
        $form = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-transaction-form.blade.php');
        $helpers = file_get_contents(dirname(__DIR__, 2) . '/resources/views/backoffice/partials/kas-helpers-js.blade.php');
        $kas = $this->view('kas.blade.php');
        $program = $this->view('kas-program.blade.php');

        // Form has metode_pembayaran input and pills
        $this->assertStringContainsString('name="metode_pembayaran"', $form);
        $this->assertStringContainsString('Transfer Bank', $form);
        $this->assertStringContainsString('Kas Tunai', $form);
        $this->assertStringContainsString('QRIS', $form);
        $this->assertStringContainsString('EDC / Debit', $form);

        // Helper getTransactionType exists and returns Masuk, Keluar, Piutang
        $this->assertStringContainsString('getTransactionType(item)', $helpers);
        $this->assertStringContainsString("label: '↑ Keluar'", $helpers);
        $this->assertStringContainsString("label: '↓ Masuk'", $helpers);
        $this->assertStringContainsString("label: '⧗ Piutang'", $helpers);

        // Kas Program table has Transaksi (Masuk/Keluar/Piutang) and Metode
        $this->assertStringContainsString('getTransactionType(item)', $program);
        $this->assertStringContainsString('item.metode_pembayaran', $program);
        $this->assertStringContainsString('<th style="width:90px;text-align:center;">Transaksi</th>', $program);
        $this->assertStringContainsString('<th style="width:95px;">Metode</th>', $program);

        // Kas Umum table also has getTransactionType and Metode
        $this->assertStringContainsString('getTransactionType(item)', $kas);
        $this->assertStringContainsString('item.metode_pembayaran', $kas);

        // Model fillable
        $trx = new \App\Models\KasTransaction();
        $this->assertContains('metode_pembayaran', $trx->getFillable());
    }
}
