function getInstelment(nominal, length_of_loan, interest_rate)
{
    nominal = parseInt(nominal.replace(/[.]/g, ''));
    interest_rate = parseInt(interest_rate.replace('%', ''));

    let count = (nominal + ((nominal*(interest_rate/100))*length_of_loan)) / length_of_loan;
    return rupiah(Math.round(count));
}