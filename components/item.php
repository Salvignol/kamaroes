<style>
.property__price{
    color: gray;
}

.property__other{
    color: rgba(100, 100, 100, .5);
}

.property__category{
    
    color: rgb(193, 238, 255);
    background:  rgba(0, 185, 255,.6);
    
    
}

.property__type{
    background: white;
}

.property__location{
    color: rgba(100, 100, 100, .5);
}

</style>


<a class="item" href="details.php?ref=1">
    <div class="item_image">
        <img src=<?php echo "assets/images/".randomPicker(array("mi.jpg", "mi2.jpg", "netflix.jpg", "darkLiving.jpg", "black.jpg"));?> alt="">
    </div>
    <div class="item_glance">
        <div class="item_infos">
            <p class="item__price property__price">CFA <?php echo randomPicker(array("260 000 000", "155 000 000", "280 000 000", "480 000 000", "500 000 000"));?></p>
            <div class="item__other property__other">
                <p class="item__category property__category"><?php echo $data['subcategory_id'];?> </p>
                <p class="item__type property__type"><?php echo "rent";?></p>
            </div>
        </div>
        
        
        
        

        <div class="item__location property__location"><p><?php echo randomPicker(array(
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. 
         ", 
        
        "Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        .", 
        
        "Lorem ipsum dolor sit amet consectetur adipisicing elit.", 
        
        "Lorem ipsum dolor sit amet consectetur adipisicing elit.", 
        
        "Lorem ipsum dolor, sit amet consectetur adipisicing elit."));?></p></div>

        </div>
</a>