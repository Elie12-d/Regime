<?php
    require('../fpdf.php');
    include('inc/fonction.php');

    class PDF extends FPDF
    {
        
        function Header()
        {
            $this->Image('assets/images/ITUlogo.jpeg',10,0,60);
            $this->SetFont('Arial','',7);
            $this->Ln(17);
            $this->setX(28);
            $this->Cell(0,0,'www.ituniversity-mg.com',0,0);
            $this->SetFont('Arial','',10);
            $this->SetTextColor(128);
            $this->setY(15);
            $this->Cell(0,10,'Annee Universitaire 2015-2016',0,0,'R');
            $this->Ln(20);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','',8);
            $this->Cell(0,0,'Fait à Anatnanarivo, le 12/09/2016',0,0,'R');
            $this->Ln(4);
            $this->Cell(187,0,"Le Recteur de l'IT University",0,0,'R');
        }

        function TitreChapitre($libelle)
        {
            $this->SetFont('Times','B',12);
            $this->SetTextColor(38,50,104);
            $this->Cell(0,6,"$libelle",0,1,'C');
            $this->Ln(10);
        }

        function TeteChapitre($header, $dataEtudiant)
        {
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','',10);

            foreach($header as $col) {
                $this->setX(20);
                $this->Cell(0,5,$col);
                $this->Ln(5.5);
            }

            $this->setY(51.2);
            $this->SetFont('Arial','B',10);

            $this->setX(46);
            $this->Cell(0,5,$dataEtudiant[0]['nom']);
            $this->Ln(5.5);

            $this->setX(46);
            $this->Cell(0,5,$dataEtudiant[0]['prenom']);
            $this->Ln(5.5);

            $this->setX(46);
            $this->Cell(0,5,$dataEtudiant[0]['date_naissance']);
            $this->setX(65.5);
            $this->SetFont('Arial','',10);
            $this->Cell(0,5,' a ');
            $this->SetFont('Arial','B',10);
            $this->setX(72.5);
            $this->Cell(0,5,$dataEtudiant[0]['lieu_naissance']);
            $this->Ln(5.5);

            $this->setX(46);
            $this->Cell(0,5,$dataEtudiant[0]['numero']);
            $this->Ln(5.5);

            $this->setX(46);
            $this->Cell(0,5,$dataEtudiant[0]['niveau']);


            $this->SetFont('Arial','',10);
            $this->Ln(7);
            $this->setX(20);
            $this->Cell(0,5,"a obtunue les notes suivantes:");
            $this->Ln(15);
        }
        function Corps($titreTab, $dataNote) {
            $this->setX(10);
            $this->SetFont('Arial','B',10);

            foreach($titreTab as $col) {
                if ($col == "Intitule") {
		        $this->Cell(50,7,$col);
                }
                else {
                    $this->Cell(40,7,$col);
                }
            }
            $this->Ln();
            $this->SetFont('Arial','',10);

            foreach($dataNote as $row) {
                if ($row['idSemestre'] == 1) {
                    $this->setX(1);
                    $this->Cell(27,6,$row['UE'],0,0,'C');
                    $this->Cell(61,6,$row['intitulé'],0,0,'R');
                    $this->Cell(40,6,$row['credit'],0,0,'C');
                    $this->Cell(40,6,$row['note'],0,0,'C');
                    $this->Cell(40,6,$row['resultat'],0,0,'C');
                    $this->Ln();
                }
            }

            $this->SetFont('Arial','B',10);
            $this->setX(50);
            $this->Cell(56,7,"SEMESTRE 1");
            $this->Cell(38,7,"30");
            $this->Cell(43,7,"10.45");
            $this->Cell(2,7,"p");
            $this->Ln(15);    

            foreach($titreTab as $col) {
                if ($col == "Intitule") {
		        $this->Cell(50,7,$col);
                }
                else {
                    $this->Cell(40,7,$col);
                }
            }
            $this->Ln();    

            $this->SetFont('Arial','',10);

            foreach($dataNote as $row) {
                if ($row['idSemestre'] == 2) {
                    $this->setX(1);
                    $this->Cell(27,6,$row['UE'],0,0,'C');
                    $this->Cell(61,6,$row['intitulé'],0,0,'R');
                    $this->Cell(40,6,$row['credit'],0,0,'C');
                    $this->Cell(40,6,$row['note'],0,0,'C');
                    $this->Cell(40,6,$row['resultat'],0,0,'C');
                    $this->Ln();
                }
            }

            $this->SetFont('Arial','B',10);
            $this->setX(50);
            $this->Cell(56,7,"SEMESTRE 2");
            $this->Cell(38,7,"30");
            $this->Cell(43,7,"10.98");
            $this->Cell(2,7,"p");
            $this->Ln(15);    
        }

        function resultGeneral() {
            $this->SetFont('Arial','B',10);
            $this->setX(7);
            $this->Cell(32,5,"Resultat general:");

            $this->SetFont('Arial','',10);
            $this->Cell(33,5,"Credits: ");
            $this->Cell(0,5,"60");
            $this->ln(6);
            $this->Cell(29);
            $this->Cell(33,5,"Moyenne general: ");
            $this->Cell(0,5,"10.72");
            $this->ln(6);
            $this->Cell(29);
            $this->Cell(33,5,"Mention: ");
            $this->Cell(0,5,"Passable");
            $this->ln(6);
            $this->Cell(29);
            $this->SetFont('Arial','B',10);
            $this->Cell(0,5,"ADMIS");
            $this->SetFont('Arial','',10);
            $this->ln(6);
            $this->Cell(29);
            $this->Cell(33,5,"Session: ");
            $this->Cell(0,5,"08/2016");
        }

        function AjouterChapitre($titre, $header, $dataEtudiant, $titreTab, $dataNote) {
            $this->AddPage();
            $this->TitreChapitre($titre);
            $this->TeteChapitre($header, $dataEtudiant);
            $this->Corps($titreTab, $dataNote);
            $this->resultGeneral();
        }
    }
    
    $pdf = new PDF();

    $titre = 'RELEVE DE NOTES ET RESULTATS';
    $header = array("Nom:", "Prenom(s):", "Ne le:", "N d'inscription:", "Inscrit en:");
    $titreTab = array("UE", "Intitule", "Credits", "Note/20", "Resultat");
    $dataEtudiant = getDataEtudiant();
    $dataNote = getDataNote();

    $pdf->SetTitle($titre);
    $pdf->SetAuthor('ITU');
    $pdf->AjouterChapitre($titre, $header, $dataEtudiant, $titreTab, $dataNote);
    $pdf->Output($_GET['action'], "releve_notes.pdf");
?>