<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago con Tarjeta</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Finalizar pago</h2>

        <form id="payment-form" class="space-y-4">
            <!-- Número de tarjeta -->
            <div>
                <label for="card-number-element" class="block text-sm font-medium text-gray-700">Número de tarjeta</label>
                <div id="card-number-element" class="p-3 border border-gray-300 rounded"></div>
            </div>

            <!-- Fecha de expiración y CVC -->
            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="card-expiry-element" class="block text-sm font-medium text-gray-700">Fecha de expiración</label>
                    <div id="card-expiry-element" class="p-3 border border-gray-300 rounded"></div>
                </div>
                <div class="flex-1">
                    <label for="card-cvc-element" class="block text-sm font-medium text-gray-700">CVC</label>
                    <div id="card-cvc-element" class="p-3 border border-gray-300 rounded"></div>
                </div>
            </div>

            <!-- Errores -->
            <div id="card-errors" class="text-red-600 text-sm mt-1"></div>

            <!-- Botón -->
            <button id="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Pagar ahora
            </button>
        </form>
    </div>

    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();

        // Crear elementos individuales
        const cardNumber = elements.create('cardNumber');
        const cardExpiry = elements.create('cardExpiry');
        const cardCvc = elements.create('cardCvc');

        // Montar en el DOM
        cardNumber.mount('#card-number-element');
        cardExpiry.mount('#card-expiry-element');
        cardCvc.mount('#card-cvc-element');

        // Manejar el formulario
        const form = document.getElementById('payment-form');
        const clientSecret = "{{ $clientSecret }}";

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardNumber,
                }
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else if (paymentIntent.status === 'succeeded') {
                window.location.href = "{{ route('purchase.success', ['purchase' => $purchase->id]) }}";
            }
        });
    </script>
</body>
</html>
