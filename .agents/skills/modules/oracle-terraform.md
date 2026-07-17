---
type: Module
title: Oracle Terraform
description: OCI compute bootstrap via Terraform and cloud-init.
tags: [terraform, oracle]
---

# Oracle Terraform

- Edit `infrastructure/terraform/oracle/terraform.tfvars` from `.example`.
- `terraform apply` → `public_ip` output.
- cloud-init template: `infrastructure/cloud-init/user-data.yaml.tpl` (`git_repo_url`, `git_branch`).
- Post-boot secrets: `/opt/app.env` copied to app `.env` (customize for your org).

Spec: [09-oracle-terraform.md](../../../specs/features/09-oracle-terraform.md)
