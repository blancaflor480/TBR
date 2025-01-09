const PRICES = {
    cottage: {
        'Pavillion': 1500,
        'Small Hut': 500,
        'Big Hut': 800,
        'Cabana': 1000,
        'Round Picnic Hut': 700,
        'Tent Pitching': 300
    },
    rooms: {
        'Aircon Room (Family)': 3500,
        'Aircon Room (Standard)': 2500,
        'Aircon Room (Air Fan)': 1500
    },
    recreational_activity: {
        'Banana Boat': 1500,
        'Island Hopping': 2500,
        'Kayak': 500,
        'Snorkelling': 500,
        'Fishing': 300,
        'Bonfire': 1000,
        'Volleyball': 200
    },
    other_amenities: {
        'Catering': 5000,
        'Light and Sounds Rental': 3000
    }
};

// Calculate totals based on selections
function calculateTotals() {
    let subtotal = 0;
    
    // Calculate cottage total
    document.querySelectorAll('input[name="cottage"]:checked').forEach(cottage => {
        subtotal += PRICES.cottage[cottage.value] || 0;
    });
    
    // Calculate rooms total
    document.querySelectorAll('input[name="rooms"]:checked').forEach(room => {
        subtotal += PRICES.rooms[room.value] || 0;
    });
    
    // Calculate recreational activities total
    document.querySelectorAll('input[name="recreational_activity"]:checked').forEach(activity => {
        subtotal += PRICES.recreational_activity[activity.value] || 0;
    });
    
    // Calculate other amenities total
    document.querySelectorAll('input[name="other_amenities"]:checked').forEach(amenity => {
        subtotal += PRICES.other_amenities[amenity.value] || 0;
    });
    
    // Calculate additional guest charges if any
    const additionalGuests = parseInt(document.querySelector('input[name="additional_guests"]').value) || 0;
    const additionalGuestCharge = additionalGuests * 100; // Assuming 100 per additional guest
    
    const total = subtotal + additionalGuestCharge;
    
    // Update the form fields
    document.querySelector('input[name="sub_total"]').value = subtotal.toFixed(2);
    document.querySelector('input[name="total"]').value = total.toFixed(2);
}

// Add event listeners to all checkboxes and the additional guests input
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotals);
    });
    
    document.querySelector('input[name="additional_guests"]').addEventListener('input', calculateTotals);
    
    // Make the total and subtotal fields readonly
    document.querySelector('input[name="sub_total"]').readOnly = true;
    document.querySelector('input[name="total"]').readOnly = true;
});

// Add price labels next to each checkbox
document.addEventListener('DOMContentLoaded', function() {
    for (const category in PRICES) {
        for (const item in PRICES[category]) {
            const checkbox = document.querySelector(`input[value="${item}"]`);
            if (checkbox) {
                const priceLabel = document.createElement('span');
                priceLabel.textContent = ` (₱${PRICES[category][item].toLocaleString()})`;
                checkbox.parentElement.appendChild(priceLabel);
            }
        }
    }
});