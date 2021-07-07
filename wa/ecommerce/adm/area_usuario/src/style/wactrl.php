<style>

.ativo:hover{
    color: #656565 !important;
}
.ativo{
    color: <?php echo $config['area_cor_second'] ?> !important;
}
.desativo:hover{
    color: <?php echo $config['area_cor_second'] ?> !important;
}
.desativo{
    color: #656565 !important;
}
.list-group-item.active {
    color: #fff;
    background-color: <?php echo $config['area_cor_second'] ?> !important;
    border-color: <?php echo $config['area_cor_second'] ?> !important;
}

.btn:hover{
    background-color: <?php echo $config['area_hover_btn_cor'] ?> !important;
    border-color: <?php echo $config['area_hover_btn_cor'] ?> !important;
} 

.btn--alt:hover{
    background-color: <?php echo $config['area_hover_btn_cor'] ?> !important;
    border-color: <?php echo $config['area_hover_btn_cor'] ?> !important;
}
.btn{
    background-color: <?php echo $config['area_btn_cor'] ?> !important;
    border-color: <?php echo $config['area_btn_cor'] ?> !important;
} 

.btn--alt{
    background-color: <?php echo $config['area_btn_cor'] ?> !important;
    border-color: <?php echo $config['area_btn_cor'] ?> !important;
}
@charset "UTF-8";
/* COLORS */
/* FLEXBOX BASE */
.flex-row {
  display: flex;
}

/* TIMELINE */
.horizontal-timeline {
  margin: 15px auto;
}
.horizontal-timeline .step {
  text-align: center;
  position: relative;
  flex-grow: 1;
}
.horizontal-timeline .step:not(:last-child)::after {
  content: "";
  background: #ccc;
  height: 3px;
  position: absolute;
  top: 25px;
  width: 100%;
  left: 50%;
  z-index: -1;
}
.horizontal-timeline .marker {
  border: 3px solid #ccc;
  background: #fff;
  border-radius: 50%;
  margin: 8px auto 2px auto;
  padding: 15px;
  width: 20px;
  height: 20px;
  font-size: 20px;
}
.horizontal-timeline .completed .marker {
  border: 3px solid <?php echo $config['area_cor_second'] ?> !important;
  background: <?php echo $config['area_cor_second'] ?> !important;
  color: #fff;
}
.horizontal-timeline .completed .marker::before {
  content: "✓";
  bottom: 10px;
  right: 7px;
  position: relative;
}
.horizontal-timeline .completed:not(:last-child)::after {
  background: <?php echo $config['area_cor_second'] ?> !important;
}
.horizontal-timeline .current {
  font-weight: bold;
}
.horizontal-timeline .current .marker {
  background: #ccc;
  border: 3px solid <?php echo $config['area_cor_second'] ?> !important;
}
</style>