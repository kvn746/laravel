require('./bootstrap');

Echo
    .private('reports')
    .listen('.report-created', (e) => {
        alert(e.message + '\n' + e.report);
    });

