<?php
function createProduct(string $name,int $price): stdClass{
    $product=new stdClass();
    $product->name=$name;
    $product->price=$price;
    return $product;
}
$coins=[200=>1,100=>1,50=>10,20=>15,10=>0,5=>7,2=>1,1=>1];//coin=>count

$products=[
    createProduct('apple',150),
    createProduct('candy',12),
    createProduct('chocolate',161),
    createProduct('cola',302)
];
$money=0;
while (true) {
    $addCoin = readline('insert coins (press just enter to stop adding coins): ');
    if ($addCoin == null){
        break;
    }
    if (! array_key_exists(($addCoin),$coins)){
        echo 'not a coin!'.PHP_EOL;
        continue;
    }
    $money=$money+$addCoin;
    $coins[$addCoin]++;
    echo "your money: $".$money/100 .PHP_EOL;
}
echo PHP_EOL.PHP_EOL;

echo "you have $".$money/100 .PHP_EOL;

foreach ($products as $key=>$product){
    echo "$key. $product->name - $".$product->price/100 .PHP_EOL;
}

$choice=readline('chose product: ');
echo PHP_EOL.PHP_EOL;

if ($money<$products[$choice]->price){
    echo 'not enough money!'.PHP_EOL;
}else {
    $money = $money - $products[$choice]->price;
}

echo "change: $".$money/100 .PHP_EOL;

$giveBack='Your change:'.PHP_EOL;

foreach ($coins as $coin=>$count){
    $coinCount=intdiv($money,$coin);
    if (intdiv($money,$coin)>=1){
        if ($count>=$coinCount) {
            $giveBack = $giveBack . $coinCount . ' - $' . $coin / 100 . PHP_EOL;
            $money = $money - $coinCount * $coin;
            $coins[$coin] = $count - $coinCount;
        }elseif ($count==0){
            continue;
        }else{
            $giveBack=$giveBack.$count. ' - $'.$coin/100 .PHP_EOL;
            $money=$money-$count*$coin;
            $coins[$coin]=0;
        }
    }
}
if ($money!=0){
    echo "Sorry, out of coins, can not give back $".$money/100 .PHP_EOL;
}
echo $giveBack;