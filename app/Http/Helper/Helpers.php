<?php 

function getInstalment($nominal, $length_of_loan, $interest_rate)
{
    return number_format((($nominal + (($nominal*($interest_rate/100))*$length_of_loan))/$length_of_loan), 0, '.', '.');
}

function getLoanStatus($status = 0)
{
    return $status == 0 ? '<span class="badge bg-warning">Pending</span>' : ($status == 1 ? '<span class="badge bg-success">Diterima</span>' : ($status == 2 ? '<span class="badge bg-danger">Ditolak</span>' : '<span class="badge bg-success">Lunas</span>'));
}

function countInstalment($nominal, $length_of_loan, $interest_rate)
{
    return number_format((($nominal + (($nominal*($interest_rate/100))*$length_of_loan))), 0, '.', '.');
}

function getUserStatus($status)
{
    return $status == 0 ? '<span class="badge bg-warning">Pending</span>' : ($status == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>');
}