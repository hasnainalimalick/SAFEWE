chrome.storage.sync.get(['login'], function(result) {
    if (result.hasOwnProperty('login')) {
        $("#nameUser").html(result.login);

    }
});