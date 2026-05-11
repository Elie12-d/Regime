<?php
require FCPATH . 'assets/fpdf186/fpdf.php';

class PDF extends FPDF
{
    public function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(42, 15, 53);
        $this->Cell(0, 8, 'Liste des traitements', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(107, 109, 143);
        $this->Cell(0, 6, 'Date: ' . date('d/m/Y'), 0, 1, 'C');
        $this->Ln(6);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(107, 109, 143);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function SectionHeader($title, $subtitle)
    {
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(42, 15, 53);
        $this->SetFillColor(230, 228, 235);
        $this->Cell(0, 7, $this->safeText($title), 0, 1, 'L', true);
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(107, 109, 143);
        $this->Cell(0, 6, $this->safeText($subtitle), 0, 1, 'L');
        $this->Ln(2);
    }

    public function RegimeItem($index, array $regime)
    {
        $contentWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        $accentWidth = 2;
        $paddingX = 5;
        $paddingY = 4;
        $bodyIndent = 2;
        $textWidth = $contentWidth - $accentWidth - ($paddingX * 2);
        $bodyTextWidth = $textWidth - $bodyIndent;

        $nameLine = ($index + 1) . '. ' . $this->safeText($regime['nom']);
        $description = $this->safeText($regime['description']);
        $stats = 'Viande ' . $this->safeText($regime['pourcentageViande']) . '% | Volaille ' .
            $this->safeText($regime['pourcentageVolaille']) . '% | Poisson ' .
            $this->safeText($regime['pourcentagePoisson']) . '% | Variation ' .
            $this->safeText($regime['variationPoids']) . ' kg';

        $this->SetFont('Arial', 'B', 10);
        $nameHeight = 6.5;
        $this->SetFont('Arial', '', 9);
        $descHeight = $this->calcMultiCellHeight($bodyTextWidth, 5.5, $description);
        $statsHeight = $this->calcMultiCellHeight($bodyTextWidth, 5.5, $stats);
        $cardHeight = $paddingY * 2 + $nameHeight + $descHeight + $statsHeight + 3;

        $this->ensureSpace($cardHeight + 4);
        $cardX = $this->GetX();
        $cardY = $this->GetY();

        $this->SetFillColor(250, 249, 252);
        $this->SetDrawColor(210, 205, 220);
        $this->Rect($cardX, $cardY, $contentWidth, $cardHeight, 'DF');

        $this->SetFillColor(108, 53, 104);
        $this->Rect($cardX, $cardY, $accentWidth, $cardHeight, 'F');

        $this->SetXY($cardX + $accentWidth + $paddingX, $cardY + $paddingY);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(42, 15, 53);
        $this->Cell($textWidth, $nameHeight, $nameLine, 0, 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(80, 84, 110);
        $this->SetX($cardX + $accentWidth + $paddingX + $bodyIndent);
        $this->MultiCell($bodyTextWidth, 5.5, $description, 0, 'L');

        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(42, 15, 53);
        $this->SetX($cardX + $accentWidth + $paddingX + $bodyIndent);
        $this->MultiCell($bodyTextWidth, 5.5, $stats, 0, 'L');
        $this->SetY($cardY + $cardHeight + 4);
    }

    private function safeText($value)
    {
        return utf8_decode((string) $value);
    }

    private function ensureSpace($height)
    {
        if ($this->GetY() + $height > $this->PageBreakTrigger) {
            $this->AddPage();
        }
    }

    private function calcMultiCellHeight($width, $lineHeight, $text)
    {
        $lines = $this->nbLines($width, $text);
        return $lines * $lineHeight;
    }

    private function nbLines($width, $text)
    {
        if ($width == 0) {
            $width = $this->w - $this->rMargin - $this->x;
        }

        $font = $this->CurrentFont;
        $cw = $font['cw'];
        $wmax = ($width - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string) $text);
        $nb = strlen($s);

        if ($nb > 0 && $s[$nb - 1] === "\n") {
            $nb--;
        }

        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;

        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c === ' ') {
                $sep = $i;
            }
            $l += $cw[$c] ?? 0;
            if ($l > $wmax) {
                if ($sep === -1) {
                    if ($i === $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }

        return $nl;
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

if (empty($listRegimes)) {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 8, 'Aucun traitement a afficher.', 1, 1, 'C');
} else {
    $groupedByDate = [];
    foreach ($listRegimes as $row) {
        $dateKey = $row['dateAchat'];
        if (!isset($groupedByDate[$dateKey])) {
            $groupedByDate[$dateKey] = [];
        }
        $groupedByDate[$dateKey][] = $row;
    }

    foreach ($groupedByDate as $date => $regimes) {
        $totalCards = 0;
        $groupedRegimes = [];

        foreach ($regimes as $regime) {
            $quantite = max(0, (int) $regime['quantite']);
            $totalCards += $quantite;
            $groupKey = $regime['id'] ?? ($regime['regime_id'] ?? $regime['nom']);
            if (!isset($groupedRegimes[$groupKey])) {
                $groupedRegimes[$groupKey] = [
                    'regime' => $regime,
                    'remaining' => 0,
                ];
            }
            $groupedRegimes[$groupKey]['remaining'] += $quantite;
        }

        $interleavedRegimes = [];
        $hasRemaining = true;
        while ($hasRemaining) {
            $hasRemaining = false;
            foreach ($groupedRegimes as &$bucket) {
                if ($bucket['remaining'] > 0) {
                    $interleavedRegimes[] = $bucket['regime'];
                    $bucket['remaining']--;
                    $hasRemaining = true;
                }
            }
            unset($bucket);
        }

        $startDate = new DateTime($date);
        $dayCount = max(1, (int) $totalCards);
        $endDate = (clone $startDate)->modify('+' . ($dayCount - 1) . ' days');

        $title = 'Du ' . $startDate->format('d/m/Y') . ' au ' . $endDate->format('d/m/Y');
        $subtitle = $dayCount . ' regime(s)';
        $pdf->SectionHeader($title, $subtitle);

        foreach ($interleavedRegimes as $index => $regime) {
            $pdf->RegimeItem($index, $regime);
        }
    }
}

$pdf->Output('D', 'Liste_regimes.pdf');
exit;
