<style>
.ad__price{
    color: #0862c7;
}

.ad__other{
    color: #053469;
}

.ad__category{
    background: #0862c7;
}

.ad__type{
    background: white;
}

.ad__location{
    color: rgba(100, 100, 100, .5);
}
</style>

<a class="item" href="details.php?ref=1">
    <div class="item_image">
        <img src="assets/images/ad1.jpg" alt="">
    </div>
    <div class="item_glance">
        <div class="item_infos">
            <p class="item__price ad__price">CFA <?php echo number_format($data['price'], $decimals = 0, $decimal_separator = ".", $thousands_separator = ",");?></p>
            <div class="item__other ad__other">
                <p class="item__category ad__category"><?php echo $data['type'];?> </p>
                <p class="item__type ad__type"><?php echo $data['mode'];?></p>
            </div>
        </div>

        <div class="item__location ad__location"><p><?php echo ucwords($data['city']).', Placeholder Neighbouhood';?></p></div>

            <!-- <div class="item__specs">
                <div class="spec">
                    <i class="fas fa-bed fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                </div>

                <div class="spec">
                    <i class="fas fa-shower fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                </div>
                            
                <div class="spec">
                    <i class="<i fas fa-ruler fa-lg"></i> <p id="wifi" name="wifi"> 4 </p>
                </div>
            </div> -->
    </div><!--item_glance-->
</a>