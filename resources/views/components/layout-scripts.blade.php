<script>
var SIDEBAR_MQ = window.matchMedia('(max-width:768px)');
function isMobileSidebar(){ return SIDEBAR_MQ.matches; }
function setSidebarOpen(open){
  var l = document.getElementById('appLayout');
  var btn = document.getElementById('menuToggle');
  l.classList.toggle('sidebar-open', open);
  document.body.classList.toggle('sidebar-open', open);
  if (btn) btn.setAttribute('aria-expanded', open ? 'true' : 'false');
}
function closeSidebar(){ if (isMobileSidebar()) setSidebarOpen(false); }
function toggleSidebar(){
  var l = document.getElementById('appLayout');
  if (isMobileSidebar()) { setSidebarOpen(!l.classList.contains('sidebar-open')); return; }
  l.classList.toggle('collapsed');
  localStorage.setItem('sidebar', l.classList.contains('collapsed') ? 'collapsed' : 'expanded');
  if (window.__simAdjustTables) setTimeout(window.__simAdjustTables, 320);
}
function toggleNavGroup(btn){
  var g = btn.closest('.nav-group');
  document.querySelectorAll('.nav-group.open').forEach(function(o){ if(o!==g) o.classList.remove('open'); });
  g.classList.toggle('open');
}
function toggleUserMenu(e){
  e.stopPropagation();
  var d = document.getElementById('userDropdown');
  var open = d.classList.toggle('open');
  d.querySelector('.user-chip').setAttribute('aria-expanded', open ? 'true' : 'false');
}
document.addEventListener('click', function(e){
  var d = document.getElementById('userDropdown');
  if (d && d.classList.contains('open') && !d.contains(e.target)){
    d.classList.remove('open');
    d.querySelector('.user-chip').setAttribute('aria-expanded','false');
  }
});
document.addEventListener('keydown', function(e){
  if (e.key === 'Escape'){
    closeSidebar();
    var d = document.getElementById('userDropdown');
    if (d && d.classList.contains('open')){
      d.classList.remove('open');
      d.querySelector('.user-chip').setAttribute('aria-expanded','false');
    }
  }
});
SIDEBAR_MQ.addEventListener('change', function(e){ if (!e.matches) closeSidebar(); });
(function(){
  var nav = document.querySelector('.sidebar nav');
  if (!nav) return;
  nav.addEventListener('click', function(e){
    if (isMobileSidebar() && e.target.closest('a')) closeSidebar();
  });
  var foot = document.querySelector('.sidebar-foot .logout-link');
  if (foot) foot.addEventListener('click', function(){ if (isMobileSidebar()) closeSidebar(); });
})();
</script>
<script src="{{ asset('assets/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.min.js') }}"></script>
<script>
$(function () {
  $('table.datatable').each(function () {
    var $t = $(this);
    if ($t.hasClass('no-auto-num')) return;
    var $headRow = $t.find('thead tr').first();
    if ($.trim($headRow.children().first().text()).toLowerCase() === 'no') return;
    $headRow.prepend('<th class="no-sort col-no">No</th>');
    $t.find('tbody tr').each(function () {
      if ($(this).children('td').first().attr('colspan')) return;
      if ($(this).children('td').length) $(this).prepend('<td class="col-no"></td>');
    });
  });
  var dtOptions = {
    pageLength: 25,
    lengthMenu: [10, 25, 50, 100],
    pagingType: 'full_numbers',
    order: [],
    columnDefs: [
      { orderable: false, targets: 'no-sort' },
      { searchable: false, targets: 'col-no' }
    ],
    language: {
      search: 'Cari:',
      lengthMenu: 'Tampilkan _MENU_ data',
      info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
      zeroRecords: 'Data tidak ditemukan',
      emptyTable: 'Belum ada data',
      paginate: { first: 'Awal', previous: 'Sebelumnya', next: 'Berikutnya', last: 'Akhir' }
    }
  };
  var apis = [];
  $('table.datatable').each(function () {
    var $t = $(this);
    var api = $t.DataTable($.extend({}, dtOptions, { scrollX: !$t.hasClass('dt-noscroll') }));
    apis.push(api);
    if ($(api.table().header()).find('th.col-no').length) {
      api.on('draw.dt', function () {
        var start = api.page.info().start;
        api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
          cell.innerHTML = start + i + 1;
        });
      });
    }
    api.draw(false);
  });
  window.__simAdjustTables = function(){ apis.forEach(function (a) { a.columns.adjust(); }); };
});
(function(){
  var box = document.getElementById('menuSearch');
  if (!box) return;
  var nav = document.querySelector('.sidebar nav');
  box.addEventListener('keyup', function(){
    var q = this.value.trim().toLowerCase();
    nav.querySelectorAll('a').forEach(function(a){
      a.style.display = a.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
    });
    nav.querySelectorAll('.label').forEach(function(l){ l.style.display = q ? 'none' : ''; });
  });
})();
</script>
