let fetch_query = (formData, entity, operation) => {
    return fetch(`${http_domain}services/${entity}/${operation}`, {
        method: "POST",
        headers: new Headers().append("Accept", "application/json"),
        body: formData,
    })
        .then((res) => {
            try {
                return res.json();
            } catch (error) {
                console.log(res.text());
                console.log(error);
                return false;
            }
        })
        .then((res) => res);
};
