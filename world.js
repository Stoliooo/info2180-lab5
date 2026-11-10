function fetchData(url) {
    const resultDiv = document.getElementById("result");
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            resultDiv.innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("lookup").addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();
        fetchData("world.php?country=" + encodeURIComponent(country));
    });

    document.getElementById("lookup_cities").addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();
        fetchData("world.php?country=" + encodeURIComponent(country) + "&lookup=cities");
    });
});