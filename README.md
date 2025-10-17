# 🌩️ QuickLagClear

**QuickLagClear** is a lightweight and automatic lag optimization plugin for **PocketMine-MP (PM5)** — designed specifically for **Minecraft: Bedrock Edition v1.21.111** servers.

It automatically clears dropped items, arrows, and other unnecessary entities at fixed intervals to keep your server running smoothly — with **zero lag spikes** and **no commands required**.

---

## 🚀 Features
- Fully **automatic optimization** (no manual commands)
- Clears **dropped items** and **arrows** safely
- Uses **asynchronous & safe batch clearing**
- Logs optimization details to console
- **Configurable interval** and enable/disable option
- Built exclusively for **PM5 API**

---

## ⚙️ Configuration (`config.yml`)
```yaml
auto_optimize: true
interval: 300 # Interval in seconds (default: 5 minutes)
