            <aside class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Continents</div>
                    <ul class="list-group">
                        <?php 
                        sort($continents); // sort the array alphabetically
                        foreach ($continents as $continent) {
                            echo "<li class=\"list-group-item\"><a href=\"list.php?continent=$continent\">$continent</a></li>";
                        }
                        ?>                        
                        
                    </ul>
                </div>
                <!-- end continents panel -->

                <div class="panel panel-info">
                    <div class="panel-heading">Popular</div>
                    <ul class="list-group">
                        <?php
                        // sort the array alphabetically
                        sort($countries); // sort the array alphabetically
                        foreach ($countries as $country) {
                            echo "<li class=\"list-group-item\"><a href=\"list.php?country=$country\">$country</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <!-- end continents panel -->
            </aside>