//update code app font size
import 'package:flutter/material.dart';
import 'package:pac_e_library_new/screens/forgetpassword_screen.dart';
import 'package:pac_e_library_new/screens/home_screen.dart';
import 'package:pac_e_library_new/screens/register_screen.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _formKey = GlobalKey<FormState>();

  final _emailCtrl = TextEditingController();
  final _passCtrl = TextEditingController();

  bool _obscure = true;
  bool _rememberMe = true;
  bool _loading = false;

  @override
  void dispose() {
    _emailCtrl.dispose();
    _passCtrl.dispose();
    super.dispose();
  }

  void _toast(String msg) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(msg), duration: const Duration(milliseconds: 900)),
    );
  }

  Future<void> _login() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _loading = true);
    await Future.delayed(const Duration(milliseconds: 900));
    if (!mounted) return;
    setState(() => _loading = false);

    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (_) => const MainShell()),
    );
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final cs = theme.colorScheme;

    // A nice "page background" that works in both modes
    final bg = theme.brightness == Brightness.dark
        ? cs.surface
        : const Color(0xFFF7F9FC);

    final fieldFill = theme.brightness == Brightness.dark
        ? cs.surfaceContainerHighest.withOpacity(0.35)
        : const Color(0xFFF7F9FC);

    return Scaffold(
      backgroundColor: bg,
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
                  _loginCard(cs, fieldFill),
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
        Row(
          children: [
            Container(
              width: 44,
              height: 44,
              decoration: BoxDecoration(
                color: cs.primary.withOpacity(0.12),
                borderRadius: BorderRadius.circular(14),
                border: Border.all(color: cs.primary.withOpacity(0.18)),
              ),
              child: Icon(Icons.local_library_rounded, color: cs.primary),
            ),
            const SizedBox(width: 10),
            Text(
              "PAC E-Library",
              style: TextStyle(
                fontSize: 42,
                fontWeight: FontWeight.w900,
                color: cs.onSurface,
              ),
            ),
          ],
        ),
        const SizedBox(height: 14),
        Text(
          "Welcome back 👋",
          style: TextStyle(
            fontSize: 26,
            fontWeight: FontWeight.w900,
            color: cs.onSurface,
          ),
        ),
        const SizedBox(height: 6),
        Text(
          "Login to continue reading and manage your library.",
          style: TextStyle(color: cs.onSurfaceVariant, height: 1.35),
        ),
      ],
    );
  }

  Widget _loginCard(ColorScheme cs, Color fieldFill) {
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
            Text("Login", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900, color: cs.onSurface)),
            const SizedBox(height: 14),

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
            const SizedBox(height: 12),

            // Password
            TextFormField(
              controller: _passCtrl,
              obscureText: _obscure,
              textInputAction: TextInputAction.done,
              onFieldSubmitted: (_) => _login(),
              decoration: InputDecoration(
                labelText: "Password",
                hintText: "••••••••",
                prefixIcon: const Icon(Icons.lock_outline_rounded),
                suffixIcon: IconButton(
                  onPressed: () => setState(() => _obscure = !_obscure),
                  icon: Icon(_obscure ? Icons.visibility_off_outlined : Icons.visibility_outlined),
                ),
                filled: true,
                fillColor: fieldFill,
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(16),
                  borderSide: BorderSide.none,
                ),
              ),
              validator: (v) {
                final s = (v ?? "");
                if (s.isEmpty) return "Please enter password";
                if (s.length < 6) return "Password must be at least 6 characters";
                return null;
              },
            ),
            const SizedBox(height: 10),

            // Remember + Forgot
            Row(
              children: [
                Checkbox(
                  value: _rememberMe,
                  onChanged: (v) => setState(() => _rememberMe = v ?? true),
                  activeColor: cs.primary,
                ),
                Text("Remember me", style: TextStyle(fontWeight: FontWeight.w700, color: cs.onSurface)),
                const Spacer(),
                TextButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (_) => const ForgetPasswordScreen()),
                    );
                  },
                  child: Text(
                    "Forgot password?",
                    style: TextStyle(fontWeight: FontWeight.w800, color: cs.primary),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 6),

            // Login button
            SizedBox(
              height: 50,
              child: ElevatedButton(
                onPressed: _loading ? null : _login,
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
                    : const Text("Login", style: TextStyle(fontWeight: FontWeight.w900)),
              ),
            ),
            const SizedBox(height: 14),

            // Divider
            Row(
              children: [
                Expanded(child: Divider(color: cs.outlineVariant.withOpacity(0.6))),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 10),
                  child: Text("or", style: TextStyle(color: cs.onSurfaceVariant)),
                ),
                Expanded(child: Divider(color: cs.outlineVariant.withOpacity(0.6))),
              ],
            ),
            const SizedBox(height: 14),

            // Social buttons (UI)
            Row(
              children: [
                Expanded(
                  child: OutlinedButton.icon(
                    onPressed: () => _toast("Google login (demo)"),
                    icon: const Icon(Icons.g_mobiledata_rounded),
                    label: const Text("Google", style: TextStyle(fontWeight: FontWeight.w800)),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: cs.onSurface,
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                      side: BorderSide(color: cs.primary.withOpacity(0.22)),
                      padding: const EdgeInsets.symmetric(vertical: 12),
                    ),
                  ),
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: OutlinedButton.icon(
                    onPressed: () => _toast("Apple login (demo)"),
                    icon: const Icon(Icons.apple_rounded),
                    label: const Text("Apple", style: TextStyle(fontWeight: FontWeight.w800)),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: cs.onSurface,
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                      side: BorderSide(color: cs.primary.withOpacity(0.22)),
                      padding: const EdgeInsets.symmetric(vertical: 12),
                    ),
                  ),
                ),
              ],
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
        Text("Don’t have an account? ", style: TextStyle(color: cs.onSurfaceVariant)),
        TextButton(
          onPressed: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (_) => const RegisterScreen()),
            );
          },
          child: Text(
            "Create account",
            style: TextStyle(fontWeight: FontWeight.w900, color: cs.primary),
          ),
        ),
      ],
    );
  }
}
