<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $paiement->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .info-block {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURE</h1>
        <h2>Sen Librairie</h2>
    </div>

    <div class="info-block">
        <strong>Facture N°:</strong> {{ $paiement->id }}<br>
        <strong>Date:</strong> {{ $paiement->datePaiement->format('d/m/Y H:i') }}<br>
        <strong>Mode de paiement:</strong> {{ $paiement->modePaiement }}
    </div>

    <div class="info-block">
        <strong>Client:</strong><br>
        {{ $paiement->commande->client->name }}<br>
        {{ $paiement->commande->client->email }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Livre</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiement->commande->livres as $book)
            <tr>
                <td>{{ $book->titre }}</td>
                <td>{{ $book->pivot->quantite }}</td>
                <td>{{ number_format($book->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($book->pivot->quantite * $book->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total payé: {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
    </div>

    <div class="footer">
        Merci de votre confiance !<br>
        Sen Librairie - Votre librairie de confiance
    </div>
</body>
</html>