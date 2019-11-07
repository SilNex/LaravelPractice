console.log("Load modal.js")

window.delete_request = () => {
    axios.delete(window.location.pathname.replace('/edit', ''))
}
