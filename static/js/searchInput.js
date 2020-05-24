function searchInput(str) {
    // Declare variables
    let input, filter, table, tr, td, i, txtValue;
    input = document.querySelector(".searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector(".cs_table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[str];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}