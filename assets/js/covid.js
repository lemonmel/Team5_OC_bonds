// ChartJS for resident covid 19

// Create Today's data
function currentCases(covid_report){
    var block_report = [];
    var block_colour = [];
    for(var i=0; i<covid_report.length; i++){
        block_report.push(covid_report[i][0])
    }
    const blocks = ["Block A", "Block B", "Block C", "Block D"];
    for(var i=0; i<block_report.length; i++){
        var block = document.getElementById(blocks[i]);
            block.textContent = blocks[i] + ": " + block_report[i];
        if(block_report[i]>=10){
            block.classList.add("alert-danger");
            block_colour.push("255, 99, 132");
        }else if(block_report[i]>=5 && block_report[i]<=9){
            block.classList.add("alert-warning");
            block_colour.push("255, 206, 86");
        }else if(block_report[i]>=1 && block_report[i]<=4){
            block.classList.add("alert-primary");
            block_colour.push("54, 162, 235");
        }else{
            block.classList.add("alert-success");
            block_colour.push("75, 192, 192");
        }
    }

    // Pie Chart
    const dailyCovidActiveData = {
        labels: [
        'Block A',
        'Block B',
        'Block C',
        'Block D',
        ],
        datasets: [{
        label: 'Yesterday Cases',
        data: block_report,
        backgroundColor: [
            'rgba('+block_colour[0]+', 0.2)',
            'rgba('+block_colour[1]+', 0.2)',
            'rgba('+block_colour[2]+', 0.2)',
            'rgba('+block_colour[3]+', 0.2)',
        ],
        borderColor:[
            'rgba('+block_colour[0]+', 1)',
            'rgba('+block_colour[1]+', 1)',
            'rgba('+block_colour[2]+', 1)',
            'rgba('+block_colour[3]+', 1)',
        ],
        borderWidth: 1,
        hoverOffset: 2
        }]
    };


    const dailyChartCtx = document.getElementById('dailyActiveCovidGraph').getContext('2d');
    const dailyChartChart = new Chart(dailyChartCtx, {
    type: 'pie',
    data: dailyCovidActiveData,
    options: {
        plugins: {
            legend: {
                display: false
            },
        }
    }
    });
}
// Weekly Bar Graph
function weeklyCases(week_arr, weekly_report){
    var active_cases = weekly_report[0];
    var new_cases = weekly_report[1]
    var recovered_cases = weekly_report[2];
    const barChartCtx = document.getElementById('weeklyCovidGraph').getContext('2d');
    const barChartChart = new Chart(barChartCtx, {
    type: 'bar',
    data: {
        labels: week_arr,
        datasets: [
            {
                label: 'Recovered Cases',
                data: recovered_cases,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor:'rgba(75, 192, 192, 1)',
                stack: 'Stack 0',
                borderWidth: 1
            },
            {
                label: 'Active Cases',
                data: active_cases,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor:'rgba(255, 206, 86, 1)',
                stack: 'Stack 1',
                borderWidth: 1
            },
            {
                label: 'New Cases',
                data: new_cases,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor:'rgba(255, 99, 132, 1)',
                stack: 'Stack 1',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
        x: {
            stacked: true,
        },
        y: {
            stacked: false
        }
        }
    }
    });
}
// Monthly Bar Graph
function monthlyCases(month_arr, monthlyReport){
    const monthlyCasesChart = document.getElementById('monthlyActiveCovidGraph').getContext('2d');
    const monthlyChart = new Chart(monthlyCasesChart, {
        type: 'bar',
        data: {
            labels: month_arr,
            datasets: [{
                label: 'No. of Cases',
                data: monthlyReport,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(13, 110, 253, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(13, 110, 253, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
