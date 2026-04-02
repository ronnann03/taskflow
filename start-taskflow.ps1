# ============================================
#   TaskFlow — Script de inicio
# ============================================

Write-Host "🚀 Iniciando TaskFlow..." -ForegroundColor Cyan

# 1. Iniciar MySQL
Write-Host "📦 Iniciando MySQL..." -ForegroundColor Yellow
Start-Service -Name "MySQL93"
Start-Sleep -Seconds 2

$mysqlStatus = (Get-Service -Name "MySQL93").Status
if ($mysqlStatus -eq "Running") {
    Write-Host "✅ MySQL corriendo" -ForegroundColor Green
} else {
    Write-Host "❌ Error al iniciar MySQL" -ForegroundColor Red
    exit
}

# 2. Iniciar Reverb (WebSockets) en nueva ventana
Write-Host "🔌 Iniciando WebSockets (Reverb)..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd C:\Users\Ronaldinhoo\taskflow; php artisan reverb:start"
Start-Sleep -Seconds 2
Write-Host "✅ Reverb corriendo en puerto 8080" -ForegroundColor Green

# 3. Iniciar Laravel en nueva ventana
Write-Host "🌐 Iniciando servidor Laravel..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd C:\Users\Ronaldinhoo\taskflow; php artisan serve"
Start-Sleep -Seconds 2
Write-Host "✅ Laravel corriendo en http://127.0.0.1:8000" -ForegroundColor Green

# 4. Abrir navegador
Write-Host "🌍 Abriendo navegador..." -ForegroundColor Yellow
Start-Sleep -Seconds 1
Start-Process "http://127.0.0.1:8000"

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  TaskFlow está listo!" -ForegroundColor Green
Write-Host "  URL: http://127.0.0.1:8000" -ForegroundColor White
Write-Host "  Email: admin@taskflow.com" -ForegroundColor White
Write-Host "  Password: Admin2024!" -ForegroundColor White
Write-Host "============================================" -ForegroundColor Cyan