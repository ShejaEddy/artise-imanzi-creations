module.exports = require("axios").create({
    baseURL: process.env.MIX_API_URL,
    headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    }
});
