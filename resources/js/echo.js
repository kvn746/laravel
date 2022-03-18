Echo
    .join('articles')
    .listen('.article-created', (e) => {
        follow = confirm(e.message + e.article.title)
        if (follow) {
            window.location.href = e.route;
        }
    });

Echo
    .join('articles')
    .listen('.article-updated', (e) => {
        follow = confirm(e.message + '\n' + e.article.title + '\n' + e.history)
        if (follow) {
            console.log(e.route);
            window.location.href = e.route;
        }
    });

Echo
    .join('articles')
    .listen('.article-deleted', (e) => {
        alert(e.message + e.article.title);
   });
