document.getElementById('booking-form').addEventListener('input', calculateTotalCost);

function calculateTotalCost() {
    const adults = parseInt(document.getElementById('adults').value, 10) || 0;
    const children = parseInt(document.getElementById('children').value, 10) || 0;
    const selectedPackage = document.getElementById('package');
    const packageText = selectedPackage.options[selectedPackage.selectedIndex].text;
    const packageCost = parseFloat(packageText.split(' - £')[1]);

    const childrenDiscountRate = 0.30;  // 30% discount for children
    const vatRate = 0.15;               // 15% VAT

    const adultsCost = adults * packageCost;
    const childrenCost = children * packageCost * (1 - childrenDiscountRate);
    const subtotal = adultsCost + childrenCost;
    const totalWithVat = subtotal * (1 + vatRate);

    document.getElementById('selected-package').textContent = packageText;
    document.getElementById('adults-count').textContent = adults;
    document.getElementById('children-count').textContent = children;
    document.getElementById('total-cost').textContent = totalWithVat.toFixed(2);

    const detailsText = `${adults} Adult(s) (£${adultsCost.toFixed(2)}) + ${children} Child(ren) (£${childrenCost.toFixed(2)}) + 15% VAT`;
    document.getElementById('cost-details').textContent = detailsText;
}
