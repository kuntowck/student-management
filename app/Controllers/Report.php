<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EnrollmentModel;
use App\Models\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Style\Alignment as Alignment;
use TCPDF;

class Report extends BaseController
{
    protected $studentModel, $enrollmentModel, $enrollmentsData;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->enrollmentModel = new EnrollmentModel();

        $this->enrollmentsData = [
            (object)[
                'id' => 1,
                'student_id' => '181001',
                'name' => 'Agus Setiawan',
                'study_program' => 'Teknik Informatika',
                'current_semester' => 5,
                'course_code' => 'IF4101',
                'course_name' => 'Pemrograman Web',
                'credits' => 3,
                'course_semester' => 4,
                'academic_year' => '2023/2024',
                'enrollment_semester' => 'Ganjil',
                'status' => 'Aktif'
            ],
            (object)[
                'id' => 2,
                'student_id' => '181001',
                'name' => 'Agus Setiawan',
                'study_program' => 'Teknik Informatika',
                'current_semester' => 5,
                'course_code' => 'IF4102',
                'course_name' => 'Basis Data Lanjut',
                'credits' => 3,
                'course_semester' => 4,
                'academic_year' => '2023/2024',
                'enrollment_semester' => 'Ganjil',
                'status' => 'Aktif'
            ],
            (object)[
                'id' => 3,
                'student_id' => '182002',
                'name' => 'Budi Santoso',
                'study_program' => 'Sistem Informasi',
                'current_semester' => 4,
                'course_code' => 'SI3201',
                'course_name' => 'Analisis Sistem Informasi',
                'credits' => 4,
                'course_semester' => 3,
                'academic_year' => '2023/2024',
                'enrollment_semester' => 'Ganjil',
                'status' => 'Aktif'
            ],
        ];
    }

    public function enrollmentForm()
    {
        $search = $this->request->getGet('search');

        $filteredData = $this->filterData($search);

        $data = [
            'title' => 'Student Course Enrollment Report',
            'enrollments' => $filteredData['enrollments'],
            'filters' => [
                'student_id' => $filteredData['student_id'],
                'name' => $filteredData['name']
            ]
        ];

        return view('reports/enrollment', $data);
    }

    private function filterData($search = '')
    {
        $enrollments = $this->enrollmentModel->getEnrollmentReport($search);

        $student_id = '';
        $name = '';

        foreach ($enrollments as $data) {
            if (!empty($search)) {
                if ($search == $data->student_id) {
                    $student_id = $data->student_id ?? [];
                } else {
                    $name = $data->student_name ?? [];
                }
            }
        }

        return [
            'enrollments' => $enrollments,
            'student_id' => $student_id,
            'name' => $name
        ];
    }

    public function enrollmentExcel()
    {
        $search = $this->request->getVar('search');

        $filteredData = $this->filterData($search);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Student Course Enrollment Report');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Filter:');
        $sheet->setCellValue('B3', 'Student ID: ' . ($filteredData['student_id'] ?? 'All'));
        $sheet->setCellValue('D3', 'Name: ' . ($filteredData['name'] ?? 'All'));
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);

        $headers = [
            'A5' => 'N0.',
            'B5' => 'Student ID',
            'C5' => 'Student Name',
            'D5' => 'Study Program',
            'E5' => 'Semester',
            'F5' => 'Course Code',
            'G5' => 'Course Name',
            'H5' => 'Credits',
            'I5' => 'Academic Year',
            'J5' => 'Status'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $row = 6;
        $no = 1;
        foreach ($filteredData['enrollments'] as $enrollment) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $enrollment->student_id);
            $sheet->setCellValue('C' . $row, $enrollment->student_name);
            $sheet->setCellValue('D' . $row, $enrollment->study_program);
            $sheet->setCellValue('E' . $row, $enrollment->semester);
            $sheet->setCellValue('F' . $row, $enrollment->course_code);
            $sheet->setCellValue('G' . $row, $enrollment->course_name);
            $sheet->setCellValue('H' . $row, $enrollment->course_credit);
            $sheet->setCellValue('I' . $row, $enrollment->academic_year);
            $sheet->setCellValue('J' . $row, ucfirst($enrollment->status));

            $row++;
            $no++;
        }

        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Buat border untuk seluruh tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A5:J' . ($row - 1))->applyFromArray($styleArray);

        $filename = 'Student_Course_Enroll_Report' . date('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function studentsbyprogramForm()
    {
        $study_programs = $this->studentModel->getAllStudyProgram();
        $entry_years = $this->studentModel->getAllEntryYear();

        $data = [
            'title' => 'List of Students by Study Program Report',
            'study_programs' => $study_programs,
            'entry_years' => $entry_years
        ];

        return view('reports/student', $data);
    }

    public function studentsbyprogramPdf()
    {
        $studyProgram = $this->request->getVar('study_program');
        $entryYear = $this->request->getVar('entry_year');

        if (!empty($studyProgram) && !empty($entryYear)) {
            $studentsData = $this->studentModel->where('study_program', $studyProgram)->where('entry_year', $entryYear)->findAll();
        } else if (!empty($studyProgram)) {
            $studentsData = $this->studentModel->where('study_program', $studyProgram)->findAll();
        } else if (!empty($entryYear)) {
            $studentsData = $this->studentModel->where('entry_year', $entryYear)->findAll();
        } else {
            $studentsData = $this->studentModel->findAll();
        }

        // Generate PDF
        $pdf = $this->initTcpdf($studyProgram);
        $this->generatePdfContent($pdf, $studentsData, $studyProgram, $entryYear);

        // Output PDF
        $filename = 'Students_report_' . date('Y-m-d') . '.pdf';
        $pdf->Output($filename, 'I');
        exit;
    }

    private function initTcpdf($studyProgram = '')
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('CodeIgniter 4');
        $pdf->SetAuthor('Administrator');
        $pdf->SetTitle('Students Report');
        $pdf->SetSubject('Students Data Report');

        $logoPath = 'assets/img/logo.png';
        $pdf->SetHeaderData(
            $logoPath,
            10,
            'UNIVERSITAS TRILOGI',
            !empty($studyProgram) ? 'Study Program: ' . $studyProgram : '',
            [0, 0, 0],
            [0, 64, 128]
        );
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);

        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 8]);

        $pdf->SetMargins(15, 20, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        $pdf->SetAutoPageBreak(true, 25);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage();

        return $pdf;
    }

    private function generatePdfContent($pdf, $students, $studyProgram, $entryYear)
    {
        $title = 'STUDENTS DATA REPORT';

        if (!empty($studyProgram)) {
            $title .= ' - STUDY PROGRAM: ' . $studyProgram;
        }

        if (!empty($entryYear)) {
            $title .= ' - ENTRY YEAR: ' . $entryYear;
        }

        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, $title, 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 5, 'Print Date: ' . date('d-m-Y H:i:s'), 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetFillColor(220, 220, 220);

        $pdf->Cell(10, 7, 'No.', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'Student ID', 1, 0, 'C', 1);
        $pdf->Cell(60, 7, 'Student Name', 1, 0, 'C', 1);
        $pdf->Cell(50, 7, 'Study Program', 1, 0, 'C', 1);
        $pdf->Cell(20, 7, 'Semester', 1, 0, 'C', 1);
        $pdf->Cell(30, 7, 'Status', 1, 0, 'C', 1);
        $pdf->Cell(25, 7, 'Entry Year', 1, 0, 'C', 1);
        $pdf->Cell(15, 7, 'GPA', 1, 1, 'C', 1);

        // Table content
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetFillColor(255, 255, 255);

        $no = 1;
        foreach ($students as $student) {
            $pdf->Cell(10, 6, $no++, 1, 0, 'C');
            $pdf->Cell(30, 6, $student->student_id, 1, 0, 'C');
            $pdf->Cell(60, 6, $student->name, 1, 0, 'L');
            $pdf->Cell(50, 6, $student->study_program, 1, 0, 'L');
            $pdf->Cell(20, 6, $student->current_semester, 1, 0, 'C');
            $pdf->Cell(30, 6, ucfirst($student->academic_status), 1, 0, 'C');
            $pdf->Cell(25, 6, $student->entry_year, 1, 0, 'C');
            $pdf->Cell(15, 6, $student->gpa, 1, 1, 'C');
        }

        // Summary
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 7, 'Total Students: ' . count($students) . ' Students', 0, 1, 'L');
    }
}
