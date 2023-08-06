function updateMaxDay()
{
    let month = document.getElementById('month').value;
    let maxDay = 31;

    if(month === 'Février') {
        maxDay = 28;
    }
    else if(month === 'Avril' || month === 'Juin' || month === 'Septembre' || month === 'Novembre') {
        maxDay = 30;
    }

    document.getElementById('day').max = maxDay;
}