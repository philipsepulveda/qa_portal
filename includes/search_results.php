<!--Created by IntelliJ IDEA.-->
<!--User: ps15-->
<!--Date: 2/03/2017-->
<!--Time: 3:46 PM-->
<?php include 'search_filters.php';?>
<div class="col-md-10" style="float:right;">
    <table class="table table-striped">
        <thead>
            <tr>
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
        <?php displaySearchResults($rootAppDir); ?>
    </table>
</div>