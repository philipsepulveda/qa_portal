<!--User: ps15-->
<!--Date: 2/03/2017-->
<!--Time: 3:46 PM-->
<div class="col-md-12 table-responsive" style="float:right;">
    <table class="display" id="example" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>
                    Test
                </th>
                <th>
                    Test Run
                </th>
                <th>
                    Environment
                </th>
                <th>
                    Summary
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>
                    Test
                </th>
                <th>
                    Test Run
                </th>
                <th>
                    Environment
                </th>
                <th>
                    Summary
                </th>
            </tr>
        </tfoot>
        <?php include 'functions/scan_dir.php'; displaySearchResults($rootAppDir); ?>
    </table>
</div>