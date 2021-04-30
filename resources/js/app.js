require('./bootstrap');

// User data
const API_TOKEN = document.getElementById('api_token').value;

// Account update
const form_update_user = document.getElementById('form_update_user');
const form_update_user_res = document.getElementById('form_update_user_res');
const form_update_user_err = document.getElementById('form_update_user_err');
form_update_user.addEventListener('submit', async e => {
    e.preventDefault();

    try {
        await fetch(form_update_user.action, {
            method: 'PUT',
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Credentials": true
            },
            body: JSON.stringify({
                "first_name": document.getElementById('first_name').value,
                "last_name": document.getElementById('last_name').value,
                "email": document.getElementById('email').value,
                "password": document.getElementById('password').value
            })

        })
            .then(response => response.json())
            .then(data => {
                form_update_user_res.textContent = data.message;
                console.log(data.user);
            })
    } catch (err) {
        form_update_user_err.textContent = err;
    }
})

// Create an ads
const form_ads = document.getElementById('form_ads');
const form_ads_res = document.getElementById('form_ads_res');
const form_ads_err = document.getElementById('form_ads_err');
form_ads.addEventListener('submit', async e => {
    e.preventDefault();

    const media = document.getElementById('photograph').files[0];
    const fd = new FormData;
    fd.append('media', media);

    try {
        await fetch(form_ads.action, {
            method: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Credentials": true
            },
            body: JSON.stringify({
                "title": document.getElementById('title').value,
                "description": document.getElementById('description').value,
                "price": document.getElementById('price').value,
                "category_id": document.getElementById('category_id').value,
            })

        })
            .then(response => response.json())
            .then(data => {
                form_ads_res.textContent = data.data.message;
                console.log(data.data.ads);
                if (media.value != '') {
                    fd.append('ads_id', data.data.ads.id);
                    sendPicture(fd);
                }
            })
    } catch (err) {
        console.log(err)
        form_ads_err.textContent = err;
    }
});

async function sendPicture(media) {
    try {
        await fetch(`/api/upload?api_token=${API_TOKEN}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: media
        })
            .then(response => response.json())
            .then(data => {
                form_ads_res.textContent = data.data.message;
                console.log(data);
            })
    } catch (err) {
        console.log(err)
        form_ads_err.textContent = err;
    }
};


// Search ads
let search_input = document.getElementById('search');
const form_search_res = document.getElementById('form_search_res');
const form_search_err = document.getElementById('form_search_err');
const form_search_res_div = document.getElementById('form_search_res_div');
search_input.addEventListener('keyup', async e => {
    e.preventDefault();
    const search = search_input.value;
    if (search.length <= 2) {
        if (!search.value == '*') {
            return;
        }
    }

    try {
        await fetch(form_search.action, {
            method: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Credentials": true
            },
            body: JSON.stringify({
                "search": search,
            })

        })
            .then(response => response.json())
            .then(data => {
                form_search_res.textContent = data.data.message;
                form_search_res_div.innerHTML = data.data.view;
                console.log(data.data.ads);
            })
    } catch (err) {
        form_search_err.textContent = err;
    }
})