//update code app font size
import 'package:flutter/material.dart';

class ForgetPasswordScreen extends StatefulWidget {
  const ForgetPasswordScreen({super.key});

  @override
  State<ForgetPasswordScreen> createState() => _ForgetPasswordScreenState();
}

class _ForgetPasswordScreenState extends State<ForgetPasswordScreen> {
  final _formKey = GlobalKey<FormState>();
  final _emailCtrl = TextEditingController();

  bool _loading = false;

  @override
  void dispose() {
    _emailCtrl.dispose();
    super.dispose();
  }

  void _toast(String msg) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(msg), duration: const Duration(milliseconds: 900)),
    );
  }

  Future<void> _sendReset() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _loading = true);
    await Future.delayed(const Duration(milliseconds: 1000));
    if (!mounted) return;
    setState(() => _loading = false);

    _toast("Password reset link sent (demo)");
    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final cs = theme.colorScheme;

    final bg = theme.brightness == Brightness.dark ? cs.surface : const Color(0xFFF7F9FC);
    final fieldFill = theme.brightness == Brightness.dark
        ? cs.surfaceContainerHighest.withOpacity(0.35)
        : const Color(0xFFF7F9FC);

    return Scaffold(
      backgroundColor: bg,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.transparent,
        foregroundColor: cs.onSurface,
      ),
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.fromLTRB(16, 16, 16, 24),
            child: ConstrainedBox(
              constraints: const BoxConstraints(maxWidth: 520),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: [
                  _header(cs),
                  const SizedBox(height: 16),
                  _formCard(cs, fieldFill),
                  const SizedBox(height: 14),
                  _footerLink(cs),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _header(ColorScheme cs) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "Forgot password?",
          style: TextStyle(fontSize: 26, fontWeight: FontWeight.w900, color: cs.onSurface),
        ),
        const SizedBox(height: 6),
        Text(
          "Enter your email and we’ll send you a reset link.",
          style: TextStyle(color: cs.onSurfaceVariant, height: 1.35),
        ),
      ],
    );
  }

  Widget _formCard(ColorScheme cs, Color fieldFill) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Theme.of(context).cardColor,
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: cs.primary.withOpacity(0.12)),
        boxShadow: [
          BoxShadow(
            blurRadius: 18,
            color: Colors.black.withOpacity(0.06),
            offset: const Offset(0, 12),
          ),
        ],
      ),
      child: Form(
        key: _formKey,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Text(
              "Reset password",
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900, color: cs.onSurface),
            ),
            const SizedBox(height: 14),

            TextFormField(
              controller: _emailCtrl,
              keyboardType: TextInputType.emailAddress,
              textInputAction: TextInputAction.done,
              decoration: InputDecoration(
                labelText: "Email",
                hintText: "name@example.com",
                prefixIcon: const Icon(Icons.email_outlined),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(16),
                  borderSide: BorderSide.none,
                ),
              ),
              validator: (v) {
                final s = (v ?? "").trim();
                if (s.isEmpty) return "Please enter email";
                if (!s.contains("@") || !s.contains(".")) return "Invalid email";
                return null;
              },
            ),
            const SizedBox(height: 14),

            SizedBox(
              height: 50,
              child: ElevatedButton(
                onPressed: _loading ? null : _sendReset,
                style: ElevatedButton.styleFrom(
                  backgroundColor: cs.primary,
                  foregroundColor: cs.onPrimary,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                ),
                child: _loading
                    ? SizedBox(
                  width: 18,
                  height: 18,
                  child: CircularProgressIndicator(strokeWidth: 2, color: cs.onPrimary),
                )
                    : const Text("Send reset link", style: TextStyle(fontWeight: FontWeight.w900)),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _footerLink(ColorScheme cs) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Text("Remembered your password? ", style: TextStyle(color: cs.onSurfaceVariant)),
        TextButton(
          onPressed: () => Navigator.pop(context),
          child: Text(
            "Back to login",
            style: TextStyle(fontWeight: FontWeight.w900, color: cs.primary),
          ),
        ),
      ],
    );
  }
}
