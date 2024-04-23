
const headers = {
    'Accept': 'application/json',
    'Content-type': 'application/json',
};

export default class HttpService {
    constructor () {
        this.baseUrl = 'http://localhost:8080';
    }

    request(url, method='GET', data=null) {
        url = `${this.baseUrl}/${url}`;
        const options = {
            headers,
            method,
        };
        if (data) {
            options.body = JSON.stringify({ ...data });
        }

        return fetch(url, options);
    }

    async get(url, id=null) {
        if(id) {
            url = `${url}/${id}`
        }

        const res = await this.request(url);
        return await res.json();
    }

    async put(url, data) {
        const res = await this.request(url, 'PUT', data);
        return await res.json();
    }

    async post(url, data) {
        const res = await this.request(url, 'POST', data);
        console.log(res);
        return await res.json();
    }
}