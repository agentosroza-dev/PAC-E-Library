//update code app font size
import 'package:flutter/material.dart';

/// =======================================================
/// NotifyScreen (StatefulWidget)
/// - Notification list
/// - Read / unread state
/// - Clear all
/// - Tap to open (demo)
/// - ✅ Themed for Light/Dark/System
/// =======================================================
class NotifyScreen extends StatefulWidget {
  const NotifyScreen({super.key});

  @override
  State<NotifyScreen> createState() => _NotifyScreenState();
}

class _NotifyScreenState extends State<NotifyScreen> {
  final List<_NotifyItem> _items = [
    _NotifyItem(
      id: "1",
      title: "New Release Available",
      message: "Clean Architecture is now available in your library.",
      time: DateTime.now().subtract(const Duration(minutes: 12)),
      type: NotifyType.newRelease,
      read: false,
    ),
    _NotifyItem(
      id: "2",
      title: "Download Complete",
      message: "Design Patterns.pdf has been downloaded successfully.",
      time: DateTime.now().subtract(const Duration(hours: 2)),
      type: NotifyType.download,
      read: false,
    ),
    _NotifyItem(
      id: "3",
      title: "Recommended for You",
      message: "You may like Domain-Driven Design.",
      time: DateTime.now().subtract(const Duration(days: 1)),
      type: NotifyType.recommend,
      read: true,
    ),
    _NotifyItem(
      id: "4",
      title: "System Update",
      message: "We’ve improved performance and fixed bugs.",
      time: DateTime.now().subtract(const Duration(days: 3)),
      type: NotifyType.system,
      read: true,
    ),
  ];

  void _markAllRead() {
    setState(() {
      for (final n in _items) {
        n.read = true;
      }
    });
  }

  void _clearAll() {
    setState(() => _items.clear());
  }

  void _open(_NotifyItem item) {
    setState(() => item.read = true);
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(item.title), duration: const Duration(milliseconds: 900)),
    );
  }

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;
    final unread = _items.where((n) => !n.read).length;

    return Scaffold(
      appBar: AppBar(
        title: const Text("Notifications", style: TextStyle(fontWeight: FontWeight.w800)),
        actions: [
          if (_items.isNotEmpty)
            IconButton(
              tooltip: "Mark all as read",
              icon: const Icon(Icons.done_all_rounded),
              onPressed: _markAllRead,
            ),
          if (_items.isNotEmpty)
            IconButton(
              tooltip: "Clear all",
              icon: const Icon(Icons.delete_outline_rounded),
              onPressed: _clearAll,
            ),
        ],
      ),
      body: _items.isEmpty
          ? Center(
        child: Text(
          "No notifications",
          style: TextStyle(color: cs.onSurfaceVariant),
        ),
      )
          : ListView.separated(
        padding: const EdgeInsets.fromLTRB(16, 12, 16, 16),
        itemCount: _items.length,
        separatorBuilder: (_, __) => const SizedBox(height: 10),
        itemBuilder: (_, i) => _notifyTile(_items[i]),
      ),
      floatingActionButton: unread > 0
          ? FloatingActionButton.extended(
        onPressed: _markAllRead,
        backgroundColor: cs.primary,
        foregroundColor: cs.onPrimary,
        icon: const Icon(Icons.done_all_rounded),
        label: Text("Mark all read ($unread)"),
      )
          : null,
    );
  }

  Widget _notifyTile(_NotifyItem n) {
    final cs = Theme.of(context).colorScheme;
    final accent = cs.primary;
    final typeColor = _typeColor(n.type, cs);
    final icon = _typeIcon(n.type);

    // Unread background using theme colors (works in dark mode)
    final bg = n.read ? Theme.of(context).cardColor : accent.withOpacity(0.10);

    return InkWell(
      borderRadius: BorderRadius.circular(18),
      onTap: () => _open(n),
      child: Container(
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: bg,
          borderRadius: BorderRadius.circular(18),
          border: Border.all(color: accent.withOpacity(0.18)),
        ),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              width: 42,
              height: 42,
              decoration: BoxDecoration(
                color: typeColor.withOpacity(0.14),
                borderRadius: BorderRadius.circular(14),
                border: Border.all(color: typeColor.withOpacity(0.28)),
              ),
              child: Icon(icon, color: typeColor),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: [
                      Expanded(
                        child: Text(
                          n.title,
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: TextStyle(
                            fontWeight: n.read ? FontWeight.w700 : FontWeight.w900,
                            color: cs.onSurface,
                          ),
                        ),
                      ),
                      if (!n.read)
                        Container(
                          width: 8,
                          height: 8,
                          decoration: const BoxDecoration(color: Colors.red, shape: BoxShape.circle),
                        ),
                    ],
                  ),
                  const SizedBox(height: 4),
                  Text(
                    n.message,
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis,
                    style: TextStyle(color: cs.onSurfaceVariant),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    _timeAgo(n.time),
                    style: TextStyle(color: cs.onSurfaceVariant.withOpacity(0.85), fontSize: 12),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  IconData _typeIcon(NotifyType t) {
    switch (t) {
      case NotifyType.newRelease:
        return Icons.new_releases_rounded;
      case NotifyType.download:
        return Icons.download_done_rounded;
      case NotifyType.recommend:
        return Icons.thumb_up_alt_rounded;
      case NotifyType.system:
        return Icons.system_update_alt_rounded;
    }
  }

  // ✅ Use ColorScheme so it looks good in both Light/Dark
  Color _typeColor(NotifyType t, ColorScheme cs) {
    switch (t) {
      case NotifyType.newRelease:
        return cs.primary;
      case NotifyType.download:
        return Colors.green;
      case NotifyType.recommend:
        return Colors.orange;
      case NotifyType.system:
        return Colors.purple;
    }
  }

  String _timeAgo(DateTime dt) {
    final diff = DateTime.now().difference(dt);
    if (diff.inMinutes < 60) return "${diff.inMinutes}m ago";
    if (diff.inHours < 24) return "${diff.inHours}h ago";
    return "${diff.inDays}d ago";
  }
}

/// =======================================================
/// Models
/// =======================================================
enum NotifyType { newRelease, download, recommend, system }

class _NotifyItem {
  final String id;
  final String title;
  final String message;
  final DateTime time;
  final NotifyType type;
  bool read;

  _NotifyItem({
    required this.id,
    required this.title,
    required this.message,
    required this.time,
    required this.type,
    this.read = false,
  });
}
