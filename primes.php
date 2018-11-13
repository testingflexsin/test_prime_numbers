<?php
$limit = 1000000;
$result = 0;
$numberOfPrimes = 0;
$primes = get_primes($limit);
$primeSum = [];

$primeSum[0] = 0;
for ($i = 0; $i < count($primes); $i++) {
    $primeSum[$i+1] = $primeSum[$i] + $primes[$i];
}

for ($i = $numberOfPrimes; $i < count($primeSum); $i++) {
    for ($j = $i-($numberOfPrimes+1); $j >= 0; $j--) {
        if ($primeSum[$i] - $primeSum[$j] > $limit) break;

        if (in_array($primeSum[$i] - $primeSum[$j], $primes)) {
            $numberOfPrimes = $i - $j;
            $result = $primeSum[$i] - $primeSum[$j];
        }
    }
}

echo "The prime number is : {$result}<br/>";
echo "It consists of {$numberOfPrimes} primes<br/>";

function get_primes($n) 
{ 
    // Create a boolean array "prime[0..n]"  
    // and initialize all entries it as true. 
    // A value in prime[i] will finally be  
    // false if i is Not a prime, else true. 
    $prime = array_fill(0, $n+1, true); 
  
    for ($p = 2; $p*$p <= $n; $p++) 
    { 
        // If prime[p] is not changed,  
        // then it is a prime 
        if ($prime[$p] == true) 
        {
            // Update all multiples of p 
            for ($i = $p*2; $i <= $n; $i += $p) 
                $prime[$i] = false; 
        } 
    } 
  
    $prime =  array_keys(array_filter($prime));
    return $prime;
}