        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="../public/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../public/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->


        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            const selectAll = document.querySelector('.form-group.select-all input');
            const allCheckbox = document.querySelectorAll('.form-group:not(.select-all) input');
            let listBoolean = [];

            allCheckbox.forEach(item => {
                item.addEventListener('change', function() {
                    allCheckbox.forEach(i => {
                        listBoolean.push(i.checked);
                    })
                    if (listBoolean.includes(false)) {
                        selectAll.checked = false;
                    } else {
                        selectAll.checked = true;
                    }
                    listBoolean = []
                })
            })

            selectAll.addEventListener('change', function() {
                if (this.checked) {
                    allCheckbox.forEach(i => {
                        i.checked = true;
                    })
                } else {
                    allCheckbox.forEach(i => {
                        i.checked = false;
                    })
                }
            })
        </script>
        </body>

        </html>