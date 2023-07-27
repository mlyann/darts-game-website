function updateTableCell(id, data) {
  const tableCell = document.getElementById(id);
  if(tableCell != null)
    tableCell.innerHTML = data;
}
