require('./bootstrap');
Echo
    .channel('reports')
    .listen('.report-created', (e) => {
        alert(e.message + '\n' + e.report);
    });

