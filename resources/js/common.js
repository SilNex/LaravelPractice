function redirect_after_delete(response) {
    if (response.status === 200) {
        var redirect = response.data['redirect'];
        if (redirect) {
            location.href = redirect;
        } else {
            console.log(response.data)
        }
    }
}

window.delete_request = () => {
    axios.delete(window.location.pathname.replace('/edit', ''))
        .then(response => {
            redirect_after_delete(response)
        })
}

window.comment_delete = (comment_id) => {
    post_id = window.location.pathname.split('/')[3]
    axios.delete(`/posts/${post_id}/comments/${comment_id}`)
        .then(response => {
            redirect_after_delete(response)
        })
}
