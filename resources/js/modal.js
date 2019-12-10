window.delete_request = () => {
    axios.delete(window.location.pathname.replace('/edit', ''))
        .then(response => {
            if (response.status === 200) {
                var redirect = response.data['redirect'];
                if (redirect) {
                    location.href = redirect;
                }
            }
        })
}
