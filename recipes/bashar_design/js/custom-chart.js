const labels = [
'January',
'February',
'March',
'April',
'May',
'June',
];

const data = {
  labels: labels,
  datasets: [{
    label: 'Monthly Sales',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
};

const config1 = {
  type: 'line',
  data: data,
  options: {}
};

const labels = [
'Camera',
'Water Bottle',
'Bannana',
'Apple',
'Lime Juice',
'Wallnut',
];

const tpData = {
  labels: labels,
  datasets: [{
    label: 'Top Product Sales',
    backgroundColor: ['rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)',],
    borderColor: ['rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)',],
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
}; 

const config2 = {
 type: 'polarArea',
 data: tpData,
 options: {
   scales: {
     y: {
       beginAtZero: true
     }
   }
 },
};