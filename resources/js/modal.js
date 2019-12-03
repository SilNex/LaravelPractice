window.delete_request = () => {
    axios.delete(window.location.pathname.replace('/edit', ''))
        .then(response => {
            if (response.status === 204) {
                window.location.href = window.location.origin + '/boards';
            }
        })
}
