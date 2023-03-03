function digitize(n) {
  console.log(String(n).split('').map(n));
  return String(n).split('').map(Number).reverse()
}

digitize(12345);