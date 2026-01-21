//update code app font size
import 'package:flutter/material.dart';

class RegisterScreen extends StatefulWidget {
  const RegisterScreen({super.key});

  @override
  State<RegisterScreen> createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  final _formKey = GlobalKey<FormState>();

  final _nameCtrl = TextEditingController();
  final _emailCtrl = TextEditingController();
  final _passCtrl = TextEditingController();
  final _confirmCtrl = TextEditingController();

  bool _obscurePass = true;
  bool _obscureConfirm = true;
  bool _agreeTerms = false;
  bool _loading = false;

  @override
  void dispose() {
    _nameCtrl.dispose();
    _emailCtrl.dispose();
    _passCtrl.dispose();
    _confirmCtrl.dispose();
    super.dispose();
  }

  void _toast(String msg) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(msg), duration: const Duration(milliseconds: 900)),
    );
  }

  Future<void> _register() async {
    if (!_formKey.currentState!.validate()) return;
    if (!_agreeTerms) {
      _toast("Please accept Terms & Privacy");
      return;
    }

    setState(() => _loading = true);
    await Future.delayed(const Duration(milliseconds: 1100));
    if (!mounted) return;
    setState(() => _loading = false);

    _toast("Account created (demo)");
    Navigator.pop(context); // back to Login
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
                  _registerCard(cs, fieldFill),
                  const SizedBox(height: 14),
                  _footerLinks(cs),
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
          "Create account",
          style: TextStyle(fontSize: 26, fontWeight: FontWeight.w900, color: cs.onSurface),
        ),
        const SizedBox(height: 6),
        Text(
          "Join E-Library to save favorites, track reading progress, and more.",
          style: TextStyle(color: cs.onSurfaceVariant, height: 1.35),
        ),
      ],
    );
  }

  Widget _registerCard(ColorScheme cs, Color fieldFill) {
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
            Text("Register", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900, color: cs.onSurface)),
            const SizedBox(height: 14),

            // Full Name
            TextFormField(
              controller: _nameCtrl,
              textInputAction: TextInputAction.next,
              decoration: InputDecoration(
                labelText: "Full name",
                prefixIcon: const Icon(Icons.person_outline_rounded),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
              ),
              validator: (v) {
                final s = (v ?? "").trim();
                if (s.isEmpty) return "Please enter your name";
                if (s.length < 2) return "Name is too short";
                return null;
              },
            ),
            const SizedBox(height: 12),

            // Email
            TextFormField(
              controller: _emailCtrl,
              keyboardType: TextInputType.emailAddress,
              textInputAction: TextInputAction.next,
              decoration: InputDecoration(
                labelText: "Email",
                hintText: "name@example.com",
                prefixIcon: const Icon(Icons.email_outlined),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
              ),
              validator: (v) {
                final s = (v ?? "").trim();
                if (s.isEmpty) return "Please enter email";
                if (!s.contains("@") || !s.contains(".")) return "Invalid email";
                return null;
              },
            ),
            const SizedBox(height: 12),

            // Password
            TextFormField(
              controller: _passCtrl,
              obscureText: _obscurePass,
              textInputAction: TextInputAction.next,
              decoration: InputDecoration(
                labelText: "Password",
                hintText: "••••••••",
                prefixIcon: const Icon(Icons.lock_outline_rounded),
                suffixIcon: IconButton(
                  onPressed: () => setState(() => _obscurePass = !_obscurePass),
                  icon: Icon(_obscurePass ? Icons.visibility_off_outlined : Icons.visibility_outlined),
                ),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
              ),
              validator: (v) {
                final s = (v ?? "");
                if (s.isEmpty) return "Please enter password";
                if (s.length < 6) return "Password must be at least 6 characters";
                return null;
              },
            ),
            const SizedBox(height: 12),

            // Confirm Password
            TextFormField(
              controller: _confirmCtrl,
              obscureText: _obscureConfirm,
              textInputAction: TextInputAction.done,
              decoration: InputDecoration(
                labelText: "Confirm password",
                hintText: "••••••••",
                prefixIcon: const Icon(Icons.lock_reset_rounded),
                suffixIcon: IconButton(
                  onPressed: () => setState(() => _obscureConfirm = !_obscureConfirm),
                  icon: Icon(_obscureConfirm ? Icons.visibility_off_outlined : Icons.visibility_outlined),
                ),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(borderRadius: BorderRadius.circular(16), borderSide: BorderSide.none),
              ),
              validator: (v) {
                if ((v ?? "").isEmpty) return "Please confirm password";
                if (v != _passCtrl.text) return "Passwords do not match";
                return null;
              },
            ),
            const SizedBox(height: 10),

            // Terms
            Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Checkbox(
                  value: _agreeTerms,
                  onChanged: (v) => setState(() => _agreeTerms = v ?? false),
                  activeColor: cs.primary,
                ),
                Expanded(
                  child: GestureDetector(
                    onTap: () => setState(() => _agreeTerms = !_agreeTerms),
                    child: Text(
                      "I agree to the Terms of Service and Privacy Policy",
                      style: TextStyle(fontWeight: FontWeight.w700, color: cs.onSurface),
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 8),

            // Register button
            SizedBox(
              height: 50,
              child: ElevatedButton(
                onPressed: _loading ? null : _register,
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
                    : const Text("Create account", style: TextStyle(fontWeight: FontWeight.w900)),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _footerLinks(ColorScheme cs) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Text("Already have an account? ", style: TextStyle(color: cs.onSurfaceVariant)),
        TextButton(
          onPressed: () => Navigator.pop(context),
          child: Text(
            "Login",
            style: TextStyle(fontWeight: FontWeight.w900, color: cs.primary),
          ),
        ),
      ],
    );
  }
}
